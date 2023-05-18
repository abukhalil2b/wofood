<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form x-data="{ phone:0,title:'' }" method="POST" action="{{ route('admin_login_store') }}">
        @csrf

<div x-text="title" class="p-3 text-center"></div>

        <div x-cloak x-show="phone == 0">
            @foreach($groups as $group)
            <div @click="phone = {{ $group->id }};title = '{{ $group->title}}' " class="mt-1 cursor-pointer card">{{ $group->title }}</div>
            @endforeach
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xl" />
        </div>

        <div x-cloak x-show="phone != 0">
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="mr-2 text-sm text-gray-600">تذكر بياناتي</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <input type="hidden" name="phone" x-model="phone">
                <x-primary-button class="ml-3">
                    تسجيل الدخول
                </x-primary-button>

                <x-secondary-button class="ml-3" @click="phone = 0">
                    الغ
                </x-secondary-button>
            </div>

        </div>

    </form>
</x-guest-layout>