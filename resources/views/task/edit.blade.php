<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="mt-1 p-1 text-gray-800 bg-[#b1efe6] rounded">
            {{ $day->title }}
        </div>

        <form method="post" action="{{ route('task.update',$task->id) }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="mt-6">
                <x-text-input type="text" name="title" class="mt-1 block w-full" placeholder="المهمة" value="{{ $task->title}}" />
                <x-input-error :messages="$errors->get('title')" />
            </div>


            <div class="mt-6 text-[#b1efe6]">
                الوقت المتوقع لإنجاز المهمة:
            </div>

            <div class="w-full">

                <div class="mt-6 text-[#b1efe6]"> من</div>
                <x-text-input type="time" class="" name="start_at" class="w-full" value="{{ $task->start_at}}" />

                <div class="mt-6 text-[#b1efe6]"> إلى</div>
                <x-text-input type="time" class="" name="end_at" class="w-full" value="{{ $task->end_at}}" />

            </div>


            <div class="mt-6 flex justify-between">
                <x-primary-button class="ml-3 w-14">
                    تحديث
                </x-primary-button>
            </div>
            <input type="hidden" value="{{ $day->id }}" name="day_id">
        </form>

    </div>


</x-app-layout>