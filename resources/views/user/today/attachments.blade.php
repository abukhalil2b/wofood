<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">


    @foreach($todayAttachments as $attachment)

    <div class="bg-white mt-1 p-1 rounded border text-xs">
        <div class="text-xl">
            {{ $attachment->title }}
        </div>
        <a class="py-3 text-xs text-blue-600" href="{{ Storage::url($attachment->url) }}">
            مرفق
        </a>
       <div class="text-xs text-gray-500"> المهمه: {{ $attachment->task->title }}</div>
       <div class="text-xs text-gray-500"> العضو: {{ $attachment->task->assignFor->name }}</div>
       <div class="text-xs text-gray-500"> الوفد أو المجموعة: {{ $attachment->task->assignFor->group->title }}</div>
    </div>

    @endforeach

    </div>
</x-app-layout>