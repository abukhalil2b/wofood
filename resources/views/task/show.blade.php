<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="bg-white mt-1 p-1 text-gray-800 border rounded ">

            <div class="text-xl">
                <span class="text-red-800">المهمة:</span>
                {{ $task->title }}
            </div>

            <div>
                <span class="text-red-800">
                    يجب أن تنجز بتاريخ:
                </span>
                <span class="text-xs text-gray-400"> {{ $task->due_date }}</span>
            </div>

            @if($task->assign_by_id != null)
            <div>
                <span class="text-red-800"> من:</span>
                {{ $task->assignby->name }}
            </div>
            @endif

            <div>
                <span class="text-red-800">
                    تم إنجازها بتاريخ:
                </span>
                <span class="text-xs text-gray-400"> {{ $task->done_at }}</span>
            </div>

        </div>
        <a class="mt-10 text-red-500" href="{{ route('task.delete',$task->id) }}">
            حذف نهائي
        </a>
    </div>

</x-app-layout>