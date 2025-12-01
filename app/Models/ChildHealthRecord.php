<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'checkup_date', 'record_type', 'title', 'description',
        'doctor_name', 'facility', 'diagnosis', 'treatment', 'medications',
        'allergies', 'notes', 'next_appointment', 'requires_followup',
        'attachments', 'recorded_by',
    ];

    protected $casts = [
        'checkup_date' => 'date',
        'next_appointment' => 'date',
        'requires_followup' => 'boolean',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopeVaccinations($query)
    {
        return $query->where('record_type', 'vaccination');
    }

    public function scopeRequiresFollowup($query)
    {
        return $query->where('requires_followup', true);
    }

    public function scopeUpcomingAppointments($query)
    {
        return $query->whereNotNull('next_appointment')
                     ->where('next_appointment', '>=', now())
                     ->orderBy('next_appointment');
    }
}
