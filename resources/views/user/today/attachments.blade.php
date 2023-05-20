<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">


        @foreach($todayAttachments as $attachment)



        <div class="bg-white mt-1 p-1 rounded border text-xs">

            <div class="text-xl">
                {{ $attachment->attachmentTitle }}
            </div>
            <a class="py-3 text-xl text-blue-600" href="{{ Storage::url($attachment->url) }}">
                مرفق
            </a>

            <div class="text-xs"> المهمه: {{ $attachment->taskTitle }}</div>
            <div class="text-xs text-gray-500"> العضو: {{ $attachment->assignForName}}</div>
            <hr class="my-2">
            <div class="text-[10px] text-gray-300">{{ $attachment->dayTitle }} {{ $attachment->dayArDate }} </div>
            <div class="text-[10px] text-gray-300">تاريخ المهمة:{{ $attachment->dayEnDate }} تاريخ إنشاء التعليق:{{ $attachment->attachmentCreatedAt }} </div>
        </div>



        @endforeach

    </div>
</x-app-layout>