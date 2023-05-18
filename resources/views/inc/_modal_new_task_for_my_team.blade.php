<div class="mt-1 space-y-6">


    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create_task_for_me')">
        + أضف له مهمة
    </x-primary-button>

    <x-modal name="create_task_for_me" :show="$errors->any()" focusable>

        <div class="p-1">
        @include('inc._username')
        </div>

        <form x-data="{ expected_duration: '' }" method="post" action="{{ route('task.for_my_team.store') }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="mt-6">
                <x-text-input type="text" name="title" class="mt-1 block w-full" placeholder="المهمة" />
                <x-input-error :messages="$errors->get('title')" />
            </div>


            <div class="mt-6 border p-1 rounded">
                <div>
                    الوقت المتوقع لإنجاز المهمة:
                </div>
                <div class="mt-2 w-full grid grid-cols-3 md:grid-cols-8 gap-1">
                    <x-text-input type="time" class="" name="start_at" />
                    <x-text-input type="time" class="" name="end_at" />
                </div>
            </div>

            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="day_id" value="{{ $day->id }}">
            <div class="mt-6 flex justify-between">

                <x-secondary-button x-on:click="$dispatch('close')" class="w-14">
                    إلغ
                </x-secondary-button>

                <x-primary-button class="ml-3 w-14">
                    حفظ
                </x-primary-button>
            </div>


        </form>
    </x-modal>
</div>