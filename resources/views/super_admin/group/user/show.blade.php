<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        <div class="mt-1">
            <div class="text-xl text-orange-500">
                <span class="text-[#00bfa8]">الاسم: </span>
                {{ $user->name }}
            </div>

            <div class="text-xl">
                <span class="text-[#00bfa8]">الهاتف: </span>
                {{ $user->phone }}
            </div>

            <div class="text-xl">
                <span class="text-[#00bfa8]">الحساب: </span>
                {{ __($user->user_type) }}
            </div>

            <div class="text-xl">
                <span class="text-[#00bfa8]">الوفد أو المجموعة: </span>
                {{ $user->group->title }}
            </div>

        </div>

        <div class="mt-3">
            @include('inc._modal_edit_user')
        </div>

        <div class="mt-3">
        <div class="text-red-400 text-xs">
        تحديث كلمة المرور (ستكون نفس رقم الهاتف)
        </div>
            <form class="mt-4" method="post" action="{{ route('super_admin.group.user.password.update',$user->id) }}">
                @csrf

                <x-primary-button class="ml-3 w-14">
                    تحديث
                </x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>