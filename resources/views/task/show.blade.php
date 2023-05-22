<x-app-layout>

    <div class="flex flex-col items-center justify-between">

        <div class="mt-1 p-1 text-gray-800">

            <div class="text-xl">
                <span class="text-[#ffb031]">المهمة:</span>
                <div class="text-white">
                    {{ $task->title }}
                </div>
            </div>

            @if($task->assign_by_id != null)
            <div class="text-[#ffb031]">
                <span> من:</span>
                <span class="mr-1 text-white">{{ $task->assignby->name }}</span>
            </div>
            @endif

            <div class="text-[#ffb031]">
                <span class=" text-xs">
                    تمت بتاريخ:
                </span>
                <span class="text-xs text-white"> {{ $task->done_at }}</span>
            </div>
        </div>

        <div class="p-1 mt-10 border border-[#00bfa8] rounded">
            مرفقات

            <form action="{{ route('task.attachment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-text-input name="title" type="text" class="w-full text-black" placeholder="عنوان الملف" />
                </div>
                <div class="mt-5 w-80">
                    <input type="file" name="attachment">
                </div>

                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <x-primary-button class="mt-5 w-full">حــفــظ </x-primary-button>
                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
            </form>

            @foreach($task->taskAttachments as $attachment)
            <div class="mt-5 card2 w-80 text-xs">
                <div class="text-[#032a38]"> {{ $attachment->title }}</div>
                <div class="mt-5 flex justify-between">
                    <a href="{{ Storage::url($attachment->url) }}">الملف</a>

                    <a onclick="return confirm('هل متأكد');" href="{{ route('task.attachment.delete',$attachment->id) }}" class="text-red-400">حذف</a>
                </div>
            </div>
            @endforeach

        </div>

        <div class="p-1 w-80 mt-10 border border-[#00bfa8] rounded">
            تعليقات
           <div class="mt-5">
           @include('inc._modal_new_subtask')
           </div>
            @foreach($task->taskSubtasks as $subtask)
            <div class="mt-5 card2 p-1 w-full text-xs text-[#003b4f] flex justify-between">
                {{ $subtask->title }}

                <a onclick="return confirm('هل متأكد');" href="{{ route('task.subtask.delete',$subtask->id) }}" class="text-red-400">حذف</a>
            </div>
            @endforeach

        </div>

    </div>

</x-app-layout>