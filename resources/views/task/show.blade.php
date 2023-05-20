<x-app-layout>

    <div class="flex flex-col items-center justify-between">

        <div class="mt-1 p-1 text-gray-800">

            <div class="text-xl">
                <span class="text-red-800">المهمة:</span>
                {{ $task->title }}
            </div>

            @if($task->assign_by_id != null)
            <div>
                <span class="text-red-800"> من:</span>
                {{ $task->assignby->name }}
            </div>
            @endif

            <div>
                <span class="text-red-800 text-xs">
                    تم إنجازها بتاريخ:
                </span>
                <span class="text-xs text-gray-400"> {{ $task->done_at }}</span>
            </div>
        </div>

        <div class="p-1 mt-20 border border-black rounded">
            مرفقات

            <form action="{{ route('task.attachment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-text-input name="title" type="text" class="w-full" placeholder="عنوان الملف" />
                </div>
                <div class="mt-1 w-80">
                    <input type="file"  name="attachment">
                </div>

                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <x-primary-button class="mt-2 w-full">حــفــظ </x-primary-button>
                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
            </form>

            @foreach($task->taskAttachments as $attachment)
            <div class="mt-2 bg-white border rounded p-1 w-80 text-xs">
               <div> {{ $attachment->title }}</div>
               <div class="flex justify-between">
               <a href="{{ Storage::url($attachment->url) }}">الملف</a>
              
              <a onclick="return confirm('هل متأكد');" href="{{ route('task.attachment.delete',$attachment->id) }}" class="text-red-400">حذف</a>
               </div>
            </div>
            @endforeach

        </div>

        <div class="p-1 w-80 mt-20 border border-black rounded">
            تعليقات
            @include('inc._modal_new_subtask')
            @foreach($task->taskSubtasks as $subtask)
            <div class="mt-1 bg-white border rounded p-1 w-full text-xs flex justify-between">
                {{ $subtask->title }}

                <a onclick="return confirm('هل متأكد');" href="{{ route('task.subtask.delete',$subtask->id) }}" class="text-red-400">حذف</a>
            </div>
            @endforeach

        </div>

    </div>

</x-app-layout>