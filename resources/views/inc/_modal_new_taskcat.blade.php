<div class="mt-1 space-y-6">


    <x-primary-button class="w-16" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create_subtask')">
        + جديد
    </x-primary-button>

    <x-modal name="create_subtask" :show="false" focusable>
   
        <form method="post" action="{{ route('super_admin.group.taskcat.store') }}" class="p-2 text-[#035b62]">
            @csrf

            <div>
            {{ $group->title }}
            </div>
            
            <div class="mt-6 flex items-center gap-1">
                عنوان التصنيف
                <x-text-input type="text" name="title" class="mt-1 block w-full" />
            </div>
            <x-input-error :messages="$errors->get('title')" />
            
            <input type="hidden" value="{{ $group->id }}" name="group_id">

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