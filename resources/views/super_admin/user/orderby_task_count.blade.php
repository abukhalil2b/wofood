<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        <div class="mt-1">

            <div class="flex justify-between items-center">
                <div>
                    الاسم
                </div>

                <div>
                    مجموع المهام
                </div>
            </div>

            @foreach($tasks as $task)
            <div class="mt-1 px-1 w-full bg-[#00bfa8] text-xs">

                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-[#032a38]"> {{ $task->name}}</div>

                        <div class=" text-gray-500">{{ $task->group_title }}</div>
                    </div>

                    <div>
                        {{ $task->count}}
                    </div>
                </div>

            </div>

            @endforeach

        </div>
    </div>
</x-app-layout>