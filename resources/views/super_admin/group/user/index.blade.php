<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        <div class="mt-1">
            <div class="text-xl text-orange-500 text-center">
                أعضاء {{ $group->title }}
            </div>
            @include('inc._modal_new_user')
            <form action="{{ route('super_admin.group.user.shfit_to_other_group') }}" method="POST">
                @csrf

                @foreach($users as $user)
                <div class="w-full mt-1 flex items-center justify-between gap-3">

                    <label class="w-full flex items-center gap-1 hover:border-gray-400 bg-white p-1 text-gray-800 border rounded">
                        <input type="checkbox" class="rounded" name="userIds[]" value="{{ $user->id }}">

                        {{ $user->name }}

                    </label>

                    <a href="{{ route('super_admin.group.user.show',$user->id) }}" class="btn-outline-orange">
                        إدارة
                    </a>
                </div>

                @endforeach

                <div class="mt-3 flex gap-1 justify-center">

                    <select name="group_id" class="w-60 rounded border">
                        <option value=""></option>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                        @endforeach
                    </select>

                    <x-primary-button class="h-12 px-2">
                        نقل الأعضاء إلي
                    </x-primary-button>

                </div>
                <x-input-error :messages="$errors->get('group_id')" class="text-center" />
            </form>
        </div>
    </div>
</x-app-layout>