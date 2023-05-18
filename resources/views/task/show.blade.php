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

            <form action="{{ route('task.attachment.store',$task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-text-input name="title" type="text" class="w-full" placeholder="عنوان الملف" />
                </div>
                <div class="mt-1 w-80">
                    <input type="file"  name="attachment">
                </div>
                <x-primary-button class="mt-2 w-full">حــفــظ </x-primary-button>
            </form>

            @foreach($task->taskAttachments as $attachment)
            <div class="mt-2 bg-white border rounded p-1 w-80 text-xs">
                {{ $attachment->title }}
            </div>
            @endforeach

        </div>

        <div class="p-1 w-80 mt-20 border border-black rounded">
            تعليقات
            @include('inc._modal_new_subtask')
            @foreach($task->taskSubtasks as $subtask)
            <div class="mt-1 bg-white border rounded p-1 w-full text-xs flex justify-between">
                {{ $subtask->title }}

                <a onclick="return confirm('هل متأكد');" href="{{ route('task.subtask.delete',$subtask->id) }}">حذف</a>
            </div>
            @endforeach

        </div>

        <div class="mt-10 py-5">
        <a class="btn-outline-orange p-1 text-red-500" href="{{ route('task.delete',$task->id) }}">
            حذف نهائي
        </a>
        </div>

    </div>

</x-app-layout>