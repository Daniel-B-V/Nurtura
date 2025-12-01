<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'donor_id', 'start_date', 'end_date', 'status',
        'monthly_amount', 'payment_frequency', 'last_payment_date',
        'next_payment_date', 'total_payments', 'total_amount',
        'special_requests', 'wants_updates', 'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'last_payment_date' => 'date',
        'next_payment_date' => 'date',
        'monthly_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'total_payments' => 'integer',
        'wants_updates' => 'boolean',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcomingPayments($query)
    {
        return $query->where('next_payment_date', '<=', now()->addDays(7));
    }
}
