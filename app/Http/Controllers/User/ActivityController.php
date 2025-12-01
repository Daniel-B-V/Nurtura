<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $days = $request->get('days', 7);

        $activities = ActivityLog::forUser($userId)
            ->recent($days)
            ->latest()
            ->paginate(20);

        $stats = [
            'total_activities' => ActivityLog::forUser($userId)->count(),
            'this_week' => ActivityLog::forUser($userId)->recent(7)->count(),
            'today' => ActivityLog::forUser($userId)
                ->whereDate('created_at', today())
                ->count(),
        ];

        $activityTypes = ActivityLog::forUser($userId)
            ->recent(30)
            ->select('action_type', DB::raw('count(*) as count'))
            ->groupBy('action_type')
            ->get();

        return view('user.activity', compact('activities', 'stats', 'activityTypes', 'days'));
    }
}
