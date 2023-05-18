<div class="mt-1">
    @foreach($todayTasks as $task)
    <div class="p-1 mt-1 bg-white border rounded">
        <div class="p-1 text-gray-800 flex justify-between">
            <div >
            <div class="text-xs text-red-800">{{ $task->day->ar_date }} </div>
                <div class="text-xl">{{ $task->title }}</div>
                <div class="flex gap-1">
                    <div class="text-xs text-gray-400"> من: {{ $task->start_at }} </div>
                    <div class="text-xs text-gray-400"> إلى: {{ $task->end_at }} </div>
                </div>

                @if($task->assign_by_id)
                <div class="text-xs">
                    من: <span class="text-orange-400">{{ $task->assignby->name }}</span>
                </div>
                @endif
            </div>

            @if($task->assign_for_id == auth()->user()->id)
            <livewire:task.make-as-done key="{{ $task->id }}" taskId="{{ $task->id }}" />
            @endif
        </div>

        <a class="text-orange-600 text-xs " href="{{ route('task.show',$task->id) }}">
            عرض التفاصيل
        </a>
    </div>
    @endforeach
</div>