<?php
/**
 * NURTURA - Complete Models Implementation Script
 *
 * This file contains all model code to copy/paste into respective files
 * Models already done: User, Child, Donor, Donation, Volunteer, VolunteerSchedule
 *
 * Copy each section to its corresponding file in app/Models/
 */

// ========================================
// InventoryCategory.php
// ========================================
$inventoryCategory = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
PHP;

// ========================================
// InventoryItem.php
// ========================================
$inventoryItem = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'sku', 'description', 'unit', 'quantity',
        'minimum_quantity', 'maximum_quantity', 'unit_cost', 'total_value',
        'location', 'expiry_date', 'status', 'notes', 'ai_forecast',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'minimum_quantity' => 'integer',
        'maximum_quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_value' => 'decimal:2',
        'expiry_date' => 'date',
        'ai_forecast' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'minimum_quantity');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', 0);
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiry_date', '<=', now()->addDays($days))
                     ->where('expiry_date', '>=', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    public function getIsLowStockAttribute()
    {
        return $this->quantity <= $this->minimum_quantity;
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->quantity == 0;
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }
}
PHP;

echo "NURTURA Models - Copy these to their respective files\n\n";
echo "All model code available in MODEL_TEMPLATES.md\n";
echo "Proceeding to create controllers and views...\n";
