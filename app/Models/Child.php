<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'photo',
        'date_of_birth',
        'gender',
        'background',
        'admission_notes',
        'admission_date',
        'status',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'metadata',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
        'metadata' => 'array',
    ];

    // Relationships
    public function healthRecords()
    {
        return $this->hasMany(ChildHealthRecord::class);
    }

    public function educationRecords()
    {
        return $this->hasMany(ChildEducationRecord::class);
    }

    public function welfareNotes()
    {
        return $this->hasMany(ChildWelfareNote::class);
    }

    public function documents()
    {
        return $this->hasMany(ChildDocument::class);
    }

    public function needs()
    {
        return $this->hasMany(ChildNeed::class);
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'allocated_to_child_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'allocated_to_child_id');
    }

    public function activeSponsorships()
    {
        return $this->sponsorships()->where('status', 'active');
    }

    public function pendingNeeds()
    {
        return $this->needs()->where('status', 'pending');
    }

    public function criticalNeeds()
    {
        return $this->needs()->where('urgency', 'critical');
    }

    public function recentWelfareNotes()
    {
        return $this->welfareNotes()->latest()->take(5);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    public function getIsSponsoredAttribute()
    {
        return $this->status === 'sponsored' || $this->activeSponsorships()->exists();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSponsored($query)
    {
        return $query->where('status', 'sponsored');
    }

    public function scopeAdopted($query)
    {
        return $query->where('status', 'adopted');
    }

    public function scopeRecentlyAdmitted($query, $days = 30)
    {
        return $query->where('admission_date', '>=', now()->subDays($days));
    }
}
