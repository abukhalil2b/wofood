<div class="mt-1 space-y-6">


    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-groups')">
        + مجموعة
    </x-primary-button>

    <x-modal name="create-groups" :show="false" focusable>
        <form method="post" action="{{ route('super_admin.group.store') }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="mt-6 flex items-center gap-1">
                <div class="w-32">
                اسم المجموعة
                </div>
                <x-text-input type="text" name="title" class="mt-1 block w-full" />
            </div>


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