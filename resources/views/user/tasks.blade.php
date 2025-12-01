<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">My Tasks</h1>
        <p class="text-gray-600 text-sm mt-1">Manage your assigned tasks and track progress</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Pending Tasks -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Pending Tasks</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_pending'] }}</p>
                </div>
            </div>
        </div>

        <!-- Overdue Tasks -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Overdue</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['overdue'] }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Today -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Completed Today</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ $stats['completed_today'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Overdue Tasks (if any) -->
        @if($overdueTasks->count() > 0)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-red-50 border-b border-red-100">
                    <h2 class="text-lg font-semibold text-red-900 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Overdue Tasks ({{ $overdueTasks->count() }})
                    </h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($overdueTasks as $task)
                        @include('user.partials.task-item', ['task' => $task, 'overdue' => true])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Pending Tasks -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Pending Tasks</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($pendingTasks as $task)
                    @include('user.partials.task-item', ['task' => $task, 'overdue' => false])
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-500">No pending tasks</p>
                        <p class="text-sm text-gray-400 mt-1">Great job! You're all caught up.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recently Completed Tasks -->
        @if($completedTasks->count() > 0)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Recently Completed</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($completedTasks as $task)
                        <div class="px-6 py-4 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 line-through">{{ $task->title }}</p>
                                            @if($task->child)
                                                <p class="text-xs text-gray-500">Child: {{ $task->child->full_name }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">{{ $task->completed_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
