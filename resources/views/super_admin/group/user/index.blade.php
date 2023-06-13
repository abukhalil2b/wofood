<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        <div class="mt-1">
            <div class="text-2xl text-orange-500 text-center">
                أعضاء {{ $group->title }}
            </div>


            <div class="mt-4 flex gap-5">
                @include('inc._modal_new_user')
                <livewire:admin.group.update-status groupId="{{ $group->id }}" />
            </div>
            <form action="{{ route('super_admin.group.user.shfit_to_other_group') }}" method="POST">
                @csrf

                @foreach($users as $user)
                <div class="w-full mt-1 flex items-center justify-between gap-1">

                    <label class="w-full flex items-center gap-1 card2">
                        <input type="checkbox" class="w-6 h-6 rounded" name="userIds[]" value="{{ $user->id }}">

                        <div>
                            {{ $user->name }}


                            <div class="text-xs text-gray-400"> {{ __( $user->user_type) }}</div>
                        </div>

                    </label>

                    <a href="{{ route('super_admin.group.user.show',$user->id) }}" class="h-12 flex items-center btn-outline-orange">
                        إدارة
                    </a>
                </div>

                @endforeach

                <div class="mt-4 flex gap-2">

                    <x-primary-button class="h-10 px-2">
                        نقل إلى
                    </x-primary-button>

                    <select name="group_id" class="w-60 rounded border">
                        <option value=""></option>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                        @endforeach
                    </select>


                </div>
                <x-input-error :messages="$errors->get('group_id')" class="text-center" />
            </form>
        </div>
    </div>
</x-app-layout>