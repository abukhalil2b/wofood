<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="mt-1">
            @foreach($todayTasks as $task)

            <div class="mt-1 p-1 bg-white rounded border">
                <span class="text-red-800">{{ $task->dayTitle }}</span>
                <span class="text-red-800">{{ $task->arDate }}</span>

                <div>
                    <div class="text-red-800">{{ $task->taskTitle }} </div>
                    <span class="text-red-800">{{ $task->taskStartAt }}</span>
                    <span class="text-red-800">{{ $task->taskEndAt }}</span>
                    <span class="text-red-800">{{ $task->taskDoneAt }}</span>
                </div>

                
                <div class="">
                    {{ $task->assignFor }}
                    <div class="text-gray-400 text-xs"> {{ $task->assignFor }}</div>
                    <div class="text-gray-400 text-xs"> {{ $task->phone }}</div>
                </div>
                <div class="text-gray-400 text-xs">{{ $task->enDate }}</div>
            </div>

            @endforeach
        </div>

    </div>


</x-app-layout>