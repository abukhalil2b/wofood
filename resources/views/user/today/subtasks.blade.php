<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">


    @foreach($todayTasks as $subtask)

    <div class="bg-white mt-1 p-1 rounded border text-xs">
        <div class="text-xl">{{ $subtask->title }}</div>
       <div class="text-xs text-gray-500"> المهمه: {{ $subtask->task->title }}</div>
       <div class="text-xs text-gray-500"> العضو: {{ $subtask->task->assignFor->name }}</div>
       <div class="text-xs text-gray-500"> الوفد أو المجموعة: {{ $subtask->task->assignFor->group->title }}</div>
    </div>

    @endforeach

    </div>
</x-app-layout>