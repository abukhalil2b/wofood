<section>
    <header>
        <h2 class="text-lg">
           تحديث كلمة المرور
        </h2>

     
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            كلمة المرور الحالية
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full text-black" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            كلمة المرور الجديدة
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full text-black" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            تأكيد كلمة المرور
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full text-black" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                تحديث
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
            تم التحديث
            </p>
            @endif
        </div>
    </form>
</section>
