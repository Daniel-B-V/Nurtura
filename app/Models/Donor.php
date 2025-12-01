<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'donor_type', 'status',
        'first_donation_date', 'last_donation_date', 'total_donated',
        'donation_count', 'notes', 'preferences', 'ai_metadata',
    ];

    protected $casts = [
        'first_donation_date' => 'date',
        'last_donation_date' => 'date',
        'total_donated' => 'decimal:2',
        'donation_count' => 'integer',
        'preferences' => 'array',
        'ai_metadata' => 'array',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function fulfilledNeeds()
    {
        return $this->hasMany(ChildNeed::class, 'fulfilled_by_donor_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'to_donor_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRecurring($query)
    {
        return $query->whereHas('donations', function ($q) {
            $q->where('is_recurring', true);
        });
    }
}
