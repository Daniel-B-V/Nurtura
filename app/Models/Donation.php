<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id', 'donation_type', 'amount', 'currency', 'description', 'items',
        'donation_date', 'payment_method', 'reference_number', 'is_anonymous',
        'is_recurring', 'frequency', 'allocated_to_child_id', 'purpose',
        'thank_you_note', 'thank_you_sent_date', 'recorded_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donation_date' => 'date',
        'thank_you_sent_date' => 'date',
        'is_anonymous' => 'boolean',
        'is_recurring' => 'boolean',
        'items' => 'array',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function child()
    {
        return $this->belongsTo(Child::class, 'allocated_to_child_id');
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'related_donation_id');
    }

    public function scopeMonetary($query)
    {
        return $query->where('donation_type', 'monetary');
    }

    public function scopeInKind($query)
    {
        return $query->where('donation_type', 'in_kind');
    }

    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }
}
