<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volunteer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'date_of_birth', 'status',
        'join_date', 'skills', 'areas_of_interest', 'availability',
        'total_hours', 'emergency_contact_name', 'emergency_contact_phone',
        'notes', 'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'join_date' => 'date',
        'skills' => 'array',
        'areas_of_interest' => 'array',
        'availability' => 'array',
        'total_hours' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(VolunteerSchedule::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
