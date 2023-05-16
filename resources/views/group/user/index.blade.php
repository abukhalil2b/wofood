<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        <div class="mt-1">
            <div>
                نقل الأعضاء إلي مجموعة أخرى
            </div>
            <form action="{{ route('group.user.shfit_to_other_group') }}" method="POST">
                @csrf

                @foreach($users as $user)
                <label class="flex items-center gap-1 hover:border-gray-400 bg-white mt-1 p-1 text-gray-800 border rounded">
                    <input type="checkbox" class="rounded" name="userIds[]" value="{{ $user->id }}">

                    {{ $user->name }}

                </label>
                @endforeach
                <div class="mt-3 flex gap-1 justify-center">

                    <select name="group_id" class="w-60 rounded border">
                        <option value=""></option>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                        @endforeach
                    </select>

                    <x-primary-button class="h-12 w-16">
                        نقل
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>