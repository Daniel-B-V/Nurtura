<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIRecommendation extends Model
{
    use HasFactory;

    protected $table = 'ai_recommendations';

    protected $fillable = [
        'recommendation_type', 'title', 'description', 'priority',
        'data', 'confidence_score', 'status', 'actioned_at',
        'actioned_by', 'action_notes',
    ];

    protected $casts = [
        'data' => 'array',
        'confidence_score' => 'decimal:2',
        'actioned_at' => 'datetime',
    ];

    public function actionedBy()
    {
        return $this->belongsTo(User::class, 'actioned_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'critical']);
    }

    public function markAsActioned($userId, $notes = null)
    {
        $this->update([
            'status' => 'actioned',
            'actioned_at' => now(),
            'actioned_by' => $userId,
            'action_notes' => $notes,
        ]);
    }
}
