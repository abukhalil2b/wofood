<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
            @include('inc._modal_new_group')

            <div class="mt-1">
                @foreach($groups as $group)
                <div class="bg-white mt-1 p-1 text-gray-800 border rounded">
                    {{ $group->title }}
                    <div class="text-xs text-gray-400">
                        <a href=" {{ route('super_admin.group.user.index',$group->id) }}" class="mt-1 p-1 inline-flex rounded border">
                        إدارة الأعضاء ({{ $group->users->count() }})
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>