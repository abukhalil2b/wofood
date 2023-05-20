<x-guest-layout>
    <form x-data="{ group_id:null }" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mt-4">
            @foreach($groups as $group)
            <div @click="group_id = {{ $group->id }}" class="option border rounded  p-1 m-1" :class="group_id == {{ $group->id }} ? 'option-selected' : 'bg-white' ">{{ $group->title }}</div>
            @endforeach
        </div>
        <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
        <input type="hidden" x-model="group_id" name="group_id">

        <div x-cloak x-show="group_id != null ">

            <!-- Name -->
            <div class="mt-4">
                الاسم
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>


            <!-- Password -->
            <div class="mt-4">
                رقم الهاتف
                <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <x-primary-button class="w-full mt-4">
                تسجيل
            </x-primary-button>
            @if( session('message') )
            <div class="mt-3 p-1 bg-green-100 text-green-600 border rounded text-center border-green-600">
                {{ session('message') }}
            </div>
            @endif

        </div>

    </form>
</x-guest-layout>