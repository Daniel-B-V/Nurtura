<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserTask;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $pendingTasks = UserTask::forUser($userId)
            ->pending()
            ->with('child')
            ->orderBy('due_date', 'asc')
            ->get();

        $completedTasks = UserTask::forUser($userId)
            ->completed()
            ->with('child', 'completedBy')
            ->latest('completed_at')
            ->limit(10)
            ->get();

        $overdueTasks = UserTask::forUser($userId)
            ->overdue()
            ->with('child')
            ->get();

        $stats = [
            'total_pending' => $pendingTasks->count(),
            'overdue' => $overdueTasks->count(),
            'completed_today' => UserTask::forUser($userId)
                ->completed()
                ->whereDate('completed_at', today())
                ->count(),
        ];

        return view('user.tasks', compact('pendingTasks', 'completedTasks', 'overdueTasks', 'stats'));
    }

    public function complete(Request $request, UserTask $task)
    {
        // Verify user owns this task
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $task->markAsCompleted(auth()->id(), $validated['notes'] ?? null);

        // Log activity
        ActivityLog::logActivity(
            auth()->id(),
            'task_completed',
            "Completed task: {$task->title}",
            'UserTask',
            $task->id
        );

        return redirect()->route('user.tasks')
            ->with('success', 'Task marked as completed!');
    }
}
