<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildWelfareNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'note_type', 'title', 'description', 'severity',
        'emotional_state', 'action_taken', 'recommendations',
        'requires_attention', 'follow_up_date', 'recorded_by',
    ];

    protected $casts = [
        'follow_up_date' => 'date',
        'requires_attention' => 'boolean',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopeCritical($query)
    {
        return $query->where('severity', 'critical');
    }

    public function scopeRequiresAttention($query)
    {
        return $query->where('requires_attention', true);
    }

    public function scopeNeedsFollowup($query)
    {
        return $query->whereNotNull('follow_up_date')
                     ->where('follow_up_date', '>=', now());
    }
}
