<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="mt-1">
            @foreach($lateTasks as $task)

            <div class="mt-1 p-1 bg-white rounded border">
                <span class="text-red-800 text-sm">{{ $task->dayTitle }} {{ $task->arDate }}</span>

                <div class="text-red-800">{{ $task->taskTitle }} </div>

                <div class="text-red-800 text-sm">من: {{ $task->taskStartAt }} إلى: {{ $task->taskEndAt }}</div>

                @if($task->taskDoneAt)
                <div class="text-red-800 text-sm">تمت: {{ $task->taskDoneAt }}</div>
                @endif


                <div class="text-gray-400 text-xs">اسندت لـ: {{ $task->assignForName }}</div>

                @if($task->assignByName)
                <div class="text-gray-400 text-xs">اسندت عن طريق: {{ $task->assignByName }}</div>
                @endif

                <div class="text-gray-400 text-xs">{{ $task->enDate }}</div>
            </div>

            @endforeach
        </div>

    </div>


</x-app-layout>