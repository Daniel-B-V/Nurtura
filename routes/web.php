<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Debug route to check user role
    Route::get('/debug-user', function () {
        $user = auth()->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'isAdmin' => $user->isAdmin(),
        ]);
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User/Staff Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/tasks', [App\Http\Controllers\User\TaskController::class, 'index'])->name('tasks');
        Route::post('/tasks/{task}/complete', [App\Http\Controllers\User\TaskController::class, 'complete'])->name('tasks.complete');
        Route::get('/activity', [App\Http\Controllers\User\ActivityController::class, 'index'])->name('activity');
    });

    // Admin-only Routes (must be before wildcard routes)
    Route::middleware('admin')->group(function () {
        // Children Management
        Route::get('/children/create', [ChildController::class, 'create'])->name('children.create');
        Route::post('/children', [ChildController::class, 'store'])->name('children.store');
        Route::get('/children/{child}/edit', [ChildController::class, 'edit'])->name('children.edit');
        Route::put('/children/{child}', [ChildController::class, 'update'])->name('children.update');
        Route::delete('/children/{child}', [ChildController::class, 'destroy'])->name('children.destroy');

        // Donor Management
        Route::get('/donors/create', [DonorController::class, 'create'])->name('donors.create');
        Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');
        Route::get('/donors/{donor}/edit', [DonorController::class, 'edit'])->name('donors.edit');
        Route::put('/donors/{donor}', [DonorController::class, 'update'])->name('donors.update');
        Route::delete('/donors/{donor}', [DonorController::class, 'destroy'])->name('donors.destroy');

        // Volunteer Management
        Route::resource('volunteers', VolunteerController::class);

        // Inventory Management
        Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/inventory/{item}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::put('/inventory/{item}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/inventory/{item}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
        Route::post('/inventory/{item}/update-stock', [InventoryController::class, 'updateStock'])->name('inventory.update-stock');
        Route::post('/inventory/{item}/restock', [InventoryController::class, 'restock'])->name('inventory.restock');

        // Sponsorship Management
        Route::resource('sponsorships', SponsorshipController::class);

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/donations', [ReportController::class, 'donations'])->name('reports.donations');
        Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');
        Route::get('/reports/children', [ReportController::class, 'children'])->name('reports.children');
        Route::get('/reports/welfare', [ReportController::class, 'welfare'])->name('reports.welfare');
    });

    // Children Routes (View-only for all authenticated users)
    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/{child}', [ChildController::class, 'show'])->name('children.show');

    // Donors Routes (View-only)
    Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
    Route::get('/donors/{donor}', [DonorController::class, 'show'])->name('donors.show');

    // Inventory Routes (View-only)
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.update.general');
    Route::put('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.update.notifications');
    Route::put('/settings/security', [SettingsController::class, 'updateSecurity'])->name('settings.update.security');

    // Search API
    Route::get('/api/search', function (\Illuminate\Http\Request $request) {
        $query = $request->get('q', '');
        $results = [];

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        // Search Children
        $children = \App\Models\Child::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('nickname', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($children as $child) {
            $results[] = [
                'id' => 'child-' . $child->id,
                'type' => 'child',
                'name' => $child->full_name,
                'subtitle' => 'Age: ' . $child->age . ' • ' . ucfirst($child->status),
                'url' => route('children.show', $child->id),
                'icon' => substr($child->first_name, 0, 1)
            ];
        }

        // Search Donors
        $donors = \App\Models\Donor::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('organization_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($donors as $donor) {
            $results[] = [
                'id' => 'donor-' . $donor->id,
                'type' => 'donor',
                'name' => $donor->full_name ?: $donor->organization_name,
                'subtitle' => $donor->email . ' • ' . ucfirst($donor->status),
                'url' => route('donors.show', $donor->id),
                'icon' => '♥'
            ];
        }

        // Search Inventory Items
        $items = \App\Models\InventoryItem::where('name', 'like', "%{$query}%")
            ->orWhere('sku', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($items as $item) {
            $results[] = [
                'id' => 'item-' . $item->id,
                'type' => 'inventory',
                'name' => $item->name,
                'subtitle' => 'Stock: ' . $item->quantity . ' ' . $item->unit . ' • ' . ($item->category->name ?? 'Uncategorized'),
                'url' => route('inventory.index'),
                'icon' => '📦'
            ];
        }

        return response()->json(['results' => $results]);
    })->name('api.search');
});

require __DIR__.'/auth.php';
