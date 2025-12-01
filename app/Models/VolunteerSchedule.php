<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id', 'schedule_date', 'start_time', 'end_time',
        'hours_worked', 'activity_type', 'description', 'status',
        'notes', 'recorded_by',
    ];

    protected $casts = [
        'schedule_date' => 'date',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('schedule_date', '>=', now())->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
