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

    public function getStockPercentageAttribute()
    {
        if ($this->maximum_quantity <= 0) {
            return 0;
        }
        return round(($this->quantity / $this->maximum_quantity) * 100);
    }

    public function getStockStatusAttribute()
    {
        if ($this->quantity <= ($this->minimum_quantity * 0.5)) {
            return 'critical';
        } elseif ($this->quantity <= $this->minimum_quantity) {
            return 'low';
        } elseif ($this->quantity >= $this->maximum_quantity) {
            return 'excellent';
        }
        return 'good';
    }

    public function getStockStatusColorAttribute()
    {
        $colors = [
            'critical' => 'red',
            'low' => 'orange',
            'good' => 'blue',
            'excellent' => 'emerald',
        ];
        return $colors[$this->stock_status] ?? 'gray';
    }

    public function getStockStatusLabelAttribute()
    {
        $labels = [
            'critical' => 'Critical',
            'low' => 'Low',
            'good' => 'Good',
            'excellent' => 'Excellent',
        ];
        return $labels[$this->stock_status] ?? 'Unknown';
    }

    public function getMonthlyUsageAttribute()
    {
        return $this->transactions()
            ->where('transaction_type', 'out')
            ->whereBetween('transaction_date', [
                now()->subMonth(),
                now()
            ])
            ->sum('quantity');
    }

    public function getDaysRemainingAttribute()
    {
        $dailyUsage = $this->monthly_usage > 0 ? $this->monthly_usage / 30 : 0;
        if ($dailyUsage <= 0) {
            return 999;
        }
        return round($this->quantity / $dailyUsage);
    }

    public function getLastRestockAttribute()
    {
        return $this->transactions()
            ->where('transaction_type', 'in')
            ->latest('transaction_date')
            ->first();
    }
}
