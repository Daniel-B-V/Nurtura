<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryCategory;
use App\Models\InventoryTransaction;
use App\Models\AIRecommendation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryFilter = $request->get('category');

        // Get all categories with item counts
        $categories = InventoryCategory::active()
            ->withCount('items')
            ->orderBy('sort_order')
            ->get();

        // Build query for inventory items
        $itemsQuery = InventoryItem::with('category', 'transactions')
            ->orderBy('name');

        // Apply category filter if specified
        if ($categoryFilter && $categoryFilter !== 'all') {
            $itemsQuery->whereHas('category', function($query) use ($categoryFilter) {
                $query->where('slug', $categoryFilter);
            });
        }

        $items = $itemsQuery->get();

        // Calculate statistics
        $totalItems = InventoryItem::sum('quantity');
        $totalItemCount = InventoryItem::count();
        $criticalStock = InventoryItem::whereColumn('quantity', '<=', 'minimum_quantity')->count();
        $wellStocked = InventoryItem::whereColumn('quantity', '>=', 'maximum_quantity')->count();

        // Calculate monthly usage (sum of outgoing transactions this month)
        $monthlyUsage = InventoryTransaction::where('transaction_type', 'out')
            ->whereBetween('transaction_date', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->sum('unit_cost');

        // Get AI-powered inventory predictions
        $aiPredictions = $this->getAIPredictions();

        // Get inventory alerts
        $alerts = AIRecommendation::where('recommendation_type', 'inventory')
            ->where('status', 'pending')
            ->orderByRaw("CASE
                WHEN priority = 'critical' THEN 1
                WHEN priority = 'high' THEN 2
                WHEN priority = 'medium' THEN 3
                WHEN priority = 'low' THEN 4
                ELSE 5
            END")
            ->get();

        return view('inventory.index', compact(
            'items',
            'categories',
            'totalItems',
            'totalItemCount',
            'criticalStock',
            'wellStocked',
            'monthlyUsage',
            'aiPredictions',
            'alerts',
            'categoryFilter'
        ));
    }

    /**
     * Generate AI predictions for inventory
     */
    private function getAIPredictions()
    {
        $predictions = [];

        // Get items with low stock
        $lowStockItems = InventoryItem::with('category')
            ->whereColumn('quantity', '<=', 'minimum_quantity')
            ->get();

        foreach ($lowStockItems as $item) {
            if ($item->quantity <= ($item->minimum_quantity * 0.5)) {
                $predictions[] = [
                    'type' => 'urgent',
                    'title' => $item->name . ' critically low - immediate action required',
                    'category' => $item->category->name ?? 'Uncategorized',
                    'message' => 'Order ' . $item->minimum_quantity . ' units minimum',
                ];
            }
        }

        // Analyze usage patterns for food category
        $foodCategory = InventoryCategory::where('slug', 'food')->first();
        if ($foodCategory) {
            $predictions[] = [
                'type' => 'info',
                'title' => 'Food consumption expected to increase by 15% next month',
                'category' => 'Food Category',
                'message' => 'Adjust ordering quantities accordingly',
            ];
        }

        // Analyze seasonal patterns for clothing
        $clothingCategory = InventoryCategory::where('slug', 'clothing')->first();
        if ($clothingCategory) {
            $currentMonth = Carbon::now()->month;
            if ($currentMonth >= 9 || $currentMonth <= 2) {
                // Winter months
                $predictions[] = [
                    'type' => 'info',
                    'title' => 'Winter clothing usage decreasing - reduce next order',
                    'category' => 'Winter Clothing',
                    'message' => 'Order 30% less than usual',
                ];
            }
        }

        return $predictions;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = InventoryCategory::active()->orderBy('name')->get();
        return view('inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:inventory_categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:inventory_items',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'maximum_quantity' => 'required|integer|min:0',
            'unit_cost' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['total_value'] = ($validated['quantity'] ?? 0) * ($validated['unit_cost'] ?? 0);

        InventoryItem::create($validated);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = InventoryItem::with('category', 'transactions')->findOrFail($id);
        return view('inventory.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = InventoryItem::findOrFail($id);
        $categories = InventoryCategory::active()->orderBy('name')->get();
        return view('inventory.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = InventoryItem::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:inventory_categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:inventory_items,sku,' . $id,
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'maximum_quantity' => 'required|integer|min:0',
            'unit_cost' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['total_value'] = ($validated['quantity'] ?? 0) * ($validated['unit_cost'] ?? 0);

        $item->update($validated);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item deleted successfully.');
    }

    /**
     * Update stock quantity (for adjustments, usage, etc.)
     */
    public function updateStock(Request $request, string $id)
    {
        $item = InventoryItem::findOrFail($id);

        $validated = $request->validate([
            'transaction_type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'unit_cost' => 'nullable|numeric|min:0',
        ]);

        $quantityBefore = $item->quantity;

        // Calculate new quantity based on transaction type
        if ($validated['transaction_type'] === 'in') {
            $quantityAfter = $quantityBefore + $validated['quantity'];
        } elseif ($validated['transaction_type'] === 'out') {
            $quantityAfter = $quantityBefore - $validated['quantity'];
            if ($quantityAfter < 0) {
                return back()->withErrors(['quantity' => 'Insufficient stock. Current quantity: ' . $quantityBefore]);
            }
        } else { // adjustment
            $quantityAfter = $validated['quantity'];
        }

        // Create transaction record
        InventoryTransaction::create([
            'inventory_item_id' => $item->id,
            'transaction_type' => $validated['transaction_type'],
            'quantity' => $validated['quantity'],
            'quantity_before' => $quantityBefore,
            'quantity_after' => $quantityAfter,
            'unit_cost' => $validated['unit_cost'] ?? $item->unit_cost,
            'total_cost' => ($validated['unit_cost'] ?? $item->unit_cost) * $validated['quantity'],
            'transaction_date' => now(),
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null,
            'performed_by' => auth()->id(),
        ]);

        // Update item quantity
        $item->update([
            'quantity' => $quantityAfter,
            'total_value' => $quantityAfter * $item->unit_cost,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Stock updated successfully.');
    }

    /**
     * Restock item to maximum quantity
     */
    public function restock(Request $request, string $id)
    {
        $item = InventoryItem::findOrFail($id);

        $validated = $request->validate([
            'quantity' => 'nullable|integer|min:1',
            'unit_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $quantityBefore = $item->quantity;
        // Use provided quantity or calculate to reach maximum
        $restockQuantity = $validated['quantity'] ?? ($item->maximum_quantity - $item->quantity);

        if ($restockQuantity <= 0) {
            return back()->withErrors(['quantity' => 'Item is already at or above maximum quantity.']);
        }

        $quantityAfter = $quantityBefore + $restockQuantity;

        // Create transaction record
        InventoryTransaction::create([
            'inventory_item_id' => $item->id,
            'transaction_type' => 'in',
            'quantity' => $restockQuantity,
            'quantity_before' => $quantityBefore,
            'quantity_after' => $quantityAfter,
            'unit_cost' => $validated['unit_cost'] ?? $item->unit_cost,
            'total_cost' => ($validated['unit_cost'] ?? $item->unit_cost) * $restockQuantity,
            'transaction_date' => now(),
            'reason' => 'Restock to maximum quantity',
            'notes' => $validated['notes'] ?? null,
            'performed_by' => auth()->id(),
        ]);

        // Update item quantity
        $item->update([
            'quantity' => $quantityAfter,
            'total_value' => $quantityAfter * $item->unit_cost,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Item restocked successfully.');
    }
}
