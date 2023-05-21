<div class="w-full">
    <div class="text-[#ffb031] text-xs"> {{ $day->title }} </div>
    <div class="text-base"> {{ $day->ar_date }} </div>
    <div class="text-xs text-gray-400"> {{ $day->en_date }} </div>
    <div class="mt-2 text-xs text-blue-600 font-serif">المهام: {{ $day->tasks_count }} </div>
    <div class="mt-2 text-xs text-blue-600 font-serif">المرفقات: {{ $day->task_attachments_count }} </div>
    <div class="mt-2 text-xs text-blue-600 font-serif">تعليقات: {{ $day->task_subtasks_count }} </div>
</div>