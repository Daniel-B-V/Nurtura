<x-app-layout>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600 text-sm mt-1">Here's your overview for today</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['my_pending_tasks'] }}</p>
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
                    <p class="text-2xl font-bold text-red-600">{{ $stats['my_overdue_tasks'] }}</p>
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

        <!-- Activities This Week -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Activities This Week</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_activities_week'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- My Tasks Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">My Tasks</h2>
                    <a href="{{ route('user.tasks') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                        View All →
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    @if($overdueTasks->count() > 0)
                        @foreach($overdueTasks->take(3) as $task)
                            <div class="px-6 py-4 bg-red-50">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-red-100 text-red-800">
                                                Overdue
                                            </span>
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800">
                                                {{ ucfirst(str_replace('_', ' ', $task->task_type)) }}
                                            </span>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-900">{{ $task->title }}</h3>
                                        @if($task->child)
                                            <p class="text-xs text-gray-500 mt-1">Related to: {{ $task->child->full_name }}</p>
                                        @endif
                                        @if($task->due_date)
                                            <p class="text-xs text-red-600 font-semibold mt-1">
                                                Due: {{ $task->due_date->format('M d, Y') }} ({{ $task->due_date->diffForHumans() }})
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @forelse($myTasks->take(5) as $task)
                        <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800">
                                            {{ ucfirst(str_replace('_', ' ', $task->task_type)) }}
                                        </span>
                                        @if($task->priority === 'urgent')
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-orange-100 text-orange-800">Urgent</span>
                                        @elseif($task->priority === 'high')
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-800">High</span>
                                        @endif
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-900">{{ $task->title }}</h3>
                                    @if($task->child)
                                        <p class="text-xs text-gray-500 mt-1">Related to: {{ $task->child->full_name }}</p>
                                    @endif
                                    @if($task->due_date)
                                        <p class="text-xs text-gray-500 mt-1">
                                            Due: {{ $task->due_date->format('M d, Y') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        @if($overdueTasks->count() === 0)
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-lg font-medium text-gray-500">No pending tasks</p>
                                <p class="text-sm text-gray-400 mt-1">You're all caught up!</p>
                            </div>
                        @endif
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                    <a href="{{ route('user.activity') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                        View All →
                    </a>
                </div>
                <div class="p-6">
                    @forelse($recentActivities->take(5) as $activity)
                        <div class="mb-4 pb-4 border-b border-gray-100 last:border-b-0">
                            <p class="text-sm text-gray-900 font-medium">{{ $activity->description }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">
                                    {{ ucfirst(str_replace('_', ' ', $activity->action_type)) }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">No recent activities</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Children Overview -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Children Overview</h2>
            <a href="{{ route('children.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                View All →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 p-6">
            @forelse($recentChildren as $child)
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative h-32 bg-gradient-to-br from-gray-200 to-gray-300">
                        @if($child->photo)
                            <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->full_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $child->full_name }}</h3>
                        <p class="text-xs text-gray-600">{{ $child->age }} years • {{ ucfirst($child->gender) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-5 text-center py-8">
                    <p class="text-sm text-gray-500">No children information available</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
