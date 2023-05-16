<div class="mt-1 space-y-6">


    <x-primary-button class="w-20" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-users')">
        + عضو
    </x-primary-button>

    <x-modal name="create-users" :show="$errors->any()" focusable>
        <form method="post" action="{{ route('user.store') }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="mt-6 flex justify-center">
                <div x-data="{ user_type:'normal' }" class="flex gap-1">
                    <div @click="user_type = 'normal' " class="option" :class=" user_type == 'normal' ? 'option-selected' : '' ">عضو</div>
                    <div @click="user_type = 'moderator' " class="option" :class=" user_type == 'moderator' ? 'option-selected' : '' ">مشرف</div>
                    <input type="hidden" x-model="user_type" name="user_type">
                </div>
            </div>

            <div class="mt-6 flex items-center gap-1">
                <div class="w-32">
                    رقم الهاتف
                </div>
                <div class="w-full">
                    <x-text-input type="number" name="phone" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>
            </div>


            <div class="mt-6 flex items-center gap-1">
                <div class="w-32">
                    الاسم
                </div>
                <div class="w-full">
                    <x-text-input type="text" name="name" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>
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