<div class="mt-1 w-full bg-[#b1efe6] border rounded p-3 ">

    <div class="flex justify-between">
        <div class="text-[#032a38]"> {{ $task->title }} </div>
        <div>
            <a href="{{ route('task.edit',['task'=>$task->id,'day'=>$day->id]) }}" class="text-orange-600 py-2 block">تعديل</a>
            <a onclick="return confirm('هل متأكد');" href="{{ route('task.delete',['task'=>$task->id,'day'=>$day->id] ) }}" class="text-red-600 py-2 block">حذف</a>
        </div>
    </div>

    @if($task->assign_by_id)
    <div class="text-red-800 text-xs"> عن طريق: {{ $task->assignby->name }} </div>
    @endif

    <div class="flex gap-1">
        <div class="text-xs text-gray-400"> من: {{ $task->start_at }} </div>
        <div class="text-xs text-gray-400"> إلى: {{ $task->end_at }} </div>
    </div>

    <div x-data="{ show:'' }">
        <div class="mt-2 flex gap-3 text-xs">
            <div @click="show = 'attachment' " class="sub-option" :class=" show == 'attachment' ? 'sub-option-selected' : '' ">
                المرفقات:{{ $task->taskAttachments->count()}}
            </div>
            <div @click="show = 'subtask' " class="sub-option" :class=" show == 'subtask' ? 'sub-option-selected' : '' ">
                تعليقات :{{ $task->taskSubtasks->count()}}
            </div>
        </div>

        <div x-cloak x-show="show == 'subtask' " class="m-3">

            @foreach($task->taskSubtasks as $subtask)
            <div class="mt-3 text-xs text-[#032a38]">
                {{ $subtask->title }}
            </div>
            @endforeach

        </div>

        <div x-cloak x-show="show == 'attachment' " class="m-3">

            @foreach($task->taskattachments as $attachment)
            <div class="mt-3 text-xs text-[#032a38] flex justify-between items-center border-b border-[#003b4f]">
               <div>
               {{ $attachment->title }}
               </div>
               <div>
               <a href="{{ Storage::url($attachment->url) }}">الملف</a>
               </div>
            </div>
            @endforeach

        </div>

    </div>
</div>