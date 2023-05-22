<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">


        @foreach($todayTasks as $subtask)

        <div class="bg-white mt-1 p-1 rounded border text-xs">
            <div class="text-xl text-[#003b4f]"> التعليق: {{ $subtask->subtaskTitle }}</div>
            <div class="text-xl text-[#003b4f]"> المهمه: {{ $subtask->taskTitle }}</div>
            <div class="text-xs text-gray-500"> العضو: {{ $subtask->assignForName}}</div>
            <hr class="my-2">
            <div class="text-[10px] text-gray-300">{{ $subtask->dayTitle }} {{ $subtask->dayArDate }} </div>
            <div class="text-[10px] text-gray-300">تاريخ المهمة:{{ $subtask->dayEnDate }} تاريخ إنشاء التعليق:{{ $subtask->subtasksCreatedAt }} </div>
        </div>

        @endforeach

    </div>
</x-app-layout>