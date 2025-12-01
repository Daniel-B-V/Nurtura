<div class="px-6 py-4 {{ $overdue ? 'bg-red-50' : 'hover:bg-gray-50' }} transition-colors">
    <div class="flex items-start justify-between gap-4">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
                <span class="px-2 py-1 text-xs font-medium rounded {{ $overdue ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ ucfirst(str_replace('_', ' ', $task->task_type)) }}
                </span>
                @if($task->priority === 'urgent')
                    <span class="px-2 py-1 text-xs font-medium rounded bg-orange-100 text-orange-800">Urgent</span>
                @elseif($task->priority === 'high')
                    <span class="px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-800">High</span>
                @endif
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $task->title }}</h3>
            @if($task->description)
                <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>
            @endif
            @if($task->child)
                <p class="text-xs text-gray-500">Related to: {{ $task->child->full_name }}</p>
            @endif
            @if($task->due_date)
                <p class="text-xs {{ $overdue ? 'text-red-600 font-semibold' : 'text-gray-500' }} mt-2">
                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Due: {{ $task->due_date->format('M d, Y') }}
                    @if($overdue)
                        ({{ $task->due_date->diffForHumans() }})
                    @endif
                </p>
            @endif
        </div>
        <div>
            <form action="{{ route('user.tasks.complete', $task) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Complete
                </button>
            </form>
        </div>
    </div>
</div>
