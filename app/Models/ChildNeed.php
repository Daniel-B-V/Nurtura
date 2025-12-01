<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'item_name', 'description', 'category', 'urgency',
        'status', 'quantity', 'estimated_cost', 'needed_by',
        'fulfilled_date', 'fulfilled_by_donor_id', 'notes', 'recorded_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'estimated_cost' => 'decimal:2',
        'needed_by' => 'date',
        'fulfilled_date' => 'date',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function fulfilledByDonor()
    {
        return $this->belongsTo(Donor::class, 'fulfilled_by_donor_id');
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCritical($query)
    {
        return $query->where('urgency', 'critical');
    }

    public function scopeFulfilled($query)
    {
        return $query->where('status', 'fulfilled');
    }
}
