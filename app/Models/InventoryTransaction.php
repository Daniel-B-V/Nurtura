<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'inventory_item_id',
        'transaction_type',
        'quantity',
        'quantity_before',
        'quantity_after',
        'unit_cost',
        'total_cost',
        'transaction_date',
        'reference_number',
        'reason',
        'notes',
        'related_donation_id',
        'allocated_to_child_id',
        'performed_by',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'quantity' => 'integer',
        'quantity_before' => 'integer',
        'quantity_after' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'related_donation_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class, 'allocated_to_child_id');
    }
}
