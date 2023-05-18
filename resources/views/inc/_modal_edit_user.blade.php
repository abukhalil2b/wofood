<div class="mt-1 space-y-6">


    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-user')" class="px-3">
        تعديل
    </x-primary-button>

    <x-modal name="edit-user" :show="$errors->any()" focusable>
    <form method="post" action="{{ route('super_admin.group.user.update',$user->id) }}">
    @csrf
    <div class="p-3 text-[#035b62]">

        <div class="mt-6 flex justify-center">
            <div x-data="{ user_type:'{{ $user->user_type }}' }" class="flex gap-1">
                <div @click="user_type = 'normal' " class="option" :class=" user_type == 'normal' ? 'option-selected' : '' ">عضو</div>
                <div @click="user_type = 'admin' " class="option" :class=" user_type == 'admin' ? 'option-selected' : '' ">رئيس أو نائبا</div>
                <input type="hidden" x-model="user_type" name="user_type">
            </div>
        </div>

        <div class="mt-6 flex items-center gap-1">
            <div class="w-32">
                رقم الهاتف
            </div>
            <div class="w-full">
                <x-text-input value="{{ $user->phone }}" type="number" name="phone" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('phone')" />
            </div>
        </div>

        <div class="mt-6 flex items-center gap-1">
            <div class="w-32">
                الاسم
            </div>
            <div class="w-full">
                <x-text-input value="{{ $user->name }}" type="text" name="name" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('name')" />
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <x-secondary-button x-on:click="$dispatch('close')" class="w-14">
                إلغ
            </x-secondary-button>

            <x-primary-button class="ml-3 w-14">
                تحديث
            </x-primary-button>
        </div>

    </div>

</form>
    </x-modal>
</div>