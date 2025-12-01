<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Inventory & Resources</h1>
            <p class="text-gray-600 text-sm mt-1">Monitor and manage all resources and supplies</p>
        </div>
        <a href="{{ route('inventory.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-400 to-teal-600 hover:from-teal-500 hover:to-teal-700 text-white font-semibold rounded-lg transition-all shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Item
        </a>
    </div>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Items -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-sm text-gray-600 mb-1">Total Items</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($totalItems) }}</div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Critical Stock -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-sm text-gray-600 mb-1">Critical Stock</div>
                        <div class="text-3xl font-bold text-red-600">{{ $criticalStock }}</div>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Monthly Usage -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-sm text-gray-600 mb-1">Monthly Usage</div>
                        <div class="text-3xl font-bold text-gray-900">${{ number_format($monthlyUsage) }}</div>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Well Stocked -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-sm text-gray-600 mb-1">Well Stocked</div>
                        <div class="text-3xl font-bold text-emerald-600">{{ $wellStocked }}</div>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Inventory Predictions & Alerts -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">AI Inventory Predictions & Alerts</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse($aiPredictions as $prediction)
                    <div class="p-4 rounded-lg border-l-4 @if($prediction['type'] === 'urgent') border-red-500 bg-red-50 @else border-blue-500 bg-blue-50 @endif">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-1">
                                @if($prediction['type'] === 'urgent')
                                    <div class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded">Urgent</div>
                                @else
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900 mb-1">{{ $prediction['title'] }}</p>
                                <p class="text-xs text-gray-600 mb-2">{{ $prediction['category'] }}</p>
                                <p class="text-xs text-@if($prediction['type'] === 'urgent')red-600@else teal-600 @endif font-medium">
                                    {{ $prediction['message'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500 text-sm">No AI predictions at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Category Tabs and Filter -->
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('inventory.index', ['category' => 'all']) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition-colors @if(!$categoryFilter || $categoryFilter === 'all') bg-gradient-to-r from-teal-400 to-teal-600 text-white @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                        All Items
                        <span class="ml-2 px-2 py-0.5 bg-white/30 rounded-full text-xs">{{ $totalItemCount }}</span>
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('inventory.index', ['category' => $category->slug]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors @if($categoryFilter === $category->slug) bg-gradient-to-r from-teal-400 to-teal-600 text-white @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                            {{ $category->name }}
                            <span class="ml-2 px-2 py-0.5 bg-white/30 rounded-full text-xs">{{ $category->items_count }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Search items..." class="pl-9 pr-4 py-2 bg-gray-100 border-0 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 focus:bg-white transition-colors">
                    </div>
                    <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Inventory Items Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($items as $item)
                @php
                    $percentage = $item->maximum_quantity > 0
                        ? round(($item->quantity / $item->maximum_quantity) * 100)
                        : 0;

                    // Determine status and styling
                    if ($item->quantity <= ($item->minimum_quantity * 0.5)) {
                        $status = 'Critical';
                        $statusColor = 'red';
                        $bgColor = 'bg-red-50';
                        $borderColor = 'border-red-200';
                    } elseif ($item->quantity <= $item->minimum_quantity) {
                        $status = 'Low';
                        $statusColor = 'orange';
                        $bgColor = 'bg-orange-50';
                        $borderColor = 'border-orange-200';
                    } elseif ($item->quantity >= $item->maximum_quantity) {
                        $status = 'Excellent';
                        $statusColor = 'emerald';
                        $bgColor = 'bg-emerald-50';
                        $borderColor = 'border-emerald-200';
                    } else {
                        $status = 'Good';
                        $statusColor = 'blue';
                        $bgColor = 'bg-blue-50';
                        $borderColor = 'border-blue-200';
                    }

                    // Calculate days until restock needed
                    $monthlyUsageRate = $item->transactions()
                        ->where('transaction_type', 'out')
                        ->whereBetween('transaction_date', [
                            \Carbon\Carbon::now()->subMonth(),
                            \Carbon\Carbon::now()
                        ])
                        ->sum('quantity');

                    $dailyUsage = $monthlyUsageRate > 0 ? $monthlyUsageRate / 30 : 0;
                    $daysRemaining = $dailyUsage > 0 ? round($item->quantity / $dailyUsage) : 999;

                    // Last restocked
                    $lastRestock = $item->transactions()
                        ->where('transaction_type', 'in')
                        ->latest('transaction_date')
                        ->first();
                    $lastRestockDate = $lastRestock ? $lastRestock->transaction_date->diffForHumans() : 'Never';
                @endphp

                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border-l-4 {{ $borderColor }}">
                    <div class="{{ $bgColor }} px-6 py-4 border-b {{ $borderColor }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900">{{ $item->name }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-{{ $statusColor }}-600 text-white text-xs font-semibold rounded">
                                        {{ $item->category->name ?? 'Uncategorized' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-{{ $statusColor }}-600 text-white text-xs font-bold rounded-full">
                                    {{ $status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Stock Progress -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-2xl font-bold text-gray-900">{{ $item->quantity }} / {{ $item->maximum_quantity }} {{ $item->unit }}</span>
                                <span class="text-2xl font-bold text-{{ $statusColor }}-600">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-{{ $statusColor }}-600 h-3 rounded-full transition-all" style="width: {{ min($percentage, 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="space-y-3 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Monthly Usage:</span>
                                <span class="font-semibold text-gray-900">{{ number_format($monthlyUsageRate) }} {{ $item->unit }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Last Restocked:</span>
                                <span class="font-semibold text-gray-900">{{ $lastRestockDate }}</span>
                            </div>
                        </div>

                        <!-- AI Prediction -->
                        @if($status === 'Critical' || $status === 'Low')
                            <div class="mt-4 p-3 bg-{{ $statusColor }}-50 border border-{{ $statusColor }}-200 rounded-lg">
                                <div class="flex items-center gap-2 text-xs">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
                                    </svg>
                                    @if($status === 'Critical')
                                        <span class="font-semibold text-red-700">Restock needed in {{ max($daysRemaining, 1) }} days</span>
                                    @else
                                        <span class="font-semibold text-orange-700">Expected to last {{ $daysRemaining }} days</span>
                                    @endif
                                </div>
                            </div>
                        @elseif($percentage >= 75)
                            <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                                <div class="flex items-center gap-2 text-xs">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
                                    </svg>
                                    <span class="font-semibold text-emerald-700">Sufficient for {{ round($daysRemaining / 30) }} months</span>
                                </div>
                            </div>
                        @else
                            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-center gap-2 text-xs">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
                                    </svg>
                                    <span class="font-semibold text-blue-700">Restock in {{ max(round($daysRemaining / 2), 10) }} days</span>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mt-4 pt-4 border-t border-gray-100">
                            <button onclick="openUpdateStockModal({{ $item->id }}, '{{ $item->name }}', {{ $item->quantity }}, '{{ $item->unit }}')"
                                    class="flex-1 px-4 py-2 border-2 border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                Update Stock
                            </button>
                            <button onclick="openRestockModal({{ $item->id }}, '{{ $item->name }}', {{ $item->quantity }}, {{ $item->maximum_quantity }}, '{{ $item->unit }}')"
                                    class="flex-1 px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                                Restock
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12">
                    <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-gray-500 text-lg font-medium">No inventory items found</p>
                    <p class="text-gray-400 text-sm mt-1">Start by adding items to your inventory</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Update Stock Modal -->
    <div id="updateStockModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center px-8 py-4">
        <div class="relative max-w-sm mx-4 shadow-xl rounded-xl bg-white p-6" style="width: 400px;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Update Stock</h3>
                    <button onclick="closeUpdateStockModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <form id="updateStockForm" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-4">Item: <span id="updateItemName" class="font-semibold text-gray-900"></span></p>
                            <p class="text-sm text-gray-600 mb-4">Current Stock: <span id="updateCurrentStock" class="font-semibold text-gray-900"></span></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Type</label>
                            <select name="transaction_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="in">Add Stock (In)</option>
                                <option value="out">Remove Stock (Out)</option>
                                <option value="adjustment">Adjust Stock</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <input type="number" name="quantity" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason</label>
                            <input type="text" name="reason" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="e.g., Weekly distribution">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeUpdateStockModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                            Update Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Restock Modal -->
    <div id="restockModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center px-8 py-4">
        <div class="relative max-w-sm mx-4 shadow-xl rounded-xl bg-white p-6" style="width: 400px;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Restock Item</h3>
                    <button onclick="closeRestockModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <form id="restockForm" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Item: <span id="restockItemName" class="font-semibold text-gray-900"></span></p>
                            <p class="text-sm text-gray-600 mb-2">Current Stock: <span id="restockCurrentStock" class="font-semibold text-gray-900"></span></p>
                            <p class="text-sm text-gray-600 mb-4">Maximum Stock: <span id="restockMaxStock" class="font-semibold text-gray-900"></span></p>
                            <p class="text-sm text-emerald-600 font-semibold mb-4">Will add: <span id="restockQuantity"></span> to reach maximum</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Custom Quantity (Optional)</label>
                            <input type="number" name="quantity" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Leave empty to fill to maximum">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit Cost (Optional)</label>
                            <input type="number" name="unit_cost" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Leave empty to use default">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeRestockModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                            Restock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openUpdateStockModal(itemId, itemName, currentStock, unit) {
            document.getElementById('updateItemName').textContent = itemName;
            document.getElementById('updateCurrentStock').textContent = currentStock + ' ' + unit;
            document.getElementById('updateStockForm').action = '/inventory/' + itemId + '/update-stock';
            document.getElementById('updateStockModal').classList.remove('hidden');
        }

        function closeUpdateStockModal() {
            document.getElementById('updateStockModal').classList.add('hidden');
            document.getElementById('updateStockForm').reset();
        }

        function openRestockModal(itemId, itemName, currentStock, maxStock, unit) {
            const restockQty = maxStock - currentStock;
            document.getElementById('restockItemName').textContent = itemName;
            document.getElementById('restockCurrentStock').textContent = currentStock + ' ' + unit;
            document.getElementById('restockMaxStock').textContent = maxStock + ' ' + unit;
            document.getElementById('restockQuantity').textContent = restockQty + ' ' + unit;
            document.getElementById('restockForm').action = '/inventory/' + itemId + '/restock';
            document.getElementById('restockModal').classList.remove('hidden');
        }

        function closeRestockModal() {
            document.getElementById('restockModal').classList.add('hidden');
            document.getElementById('restockForm').reset();
        }

        // Close modals when clicking outside
        document.getElementById('updateStockModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeUpdateStockModal();
            }
        });

        document.getElementById('restockModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeRestockModal();
            }
        });
    </script>
</x-app-layout>
