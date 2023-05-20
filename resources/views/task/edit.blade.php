<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <form method="post" action="{{ route('task.update',$task->id) }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="mt-6">
                <x-text-input type="text" name="title" class="mt-1 block w-full" placeholder="المهمة" value="{{ $task->title}}" />
                <x-input-error :messages="$errors->get('title')" />
            </div>


            <div class="mt-6">
                الوقت المتوقع لإنجاز المهمة:
            </div>
            <div class="mt-2 w-full grid grid-cols-3 md:grid-cols-8 gap-1">
                <x-text-input type="time" class="" name="start_at" value="{{ $task->start_at}}" />
                <x-text-input type="time" class="" name="end_at" value="{{ $task->end_at}}" />
            </div>


            <div class="mt-6 flex justify-between">
                <x-primary-button class="ml-3 w-14">
                    تحديث
                </x-primary-button>
            </div>

        </form>

    </div>


</x-app-layout>