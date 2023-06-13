<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
            @include('inc._modal_new_group')

            <div class="mt-1">
                @foreach($groups as $group)
                <div class="card2 {{ $group->active ? '' : 'opacity-40' }} ">
                    {{ $group->title }}
                    <div class="text-xs text-gray-400 flex items-center gap-1">
                        <a href=" {{ route('super_admin.group.user.index',$group->id) }}" class="mt-1 p-1 inline-flex rounded border border-[#032a38]">
                        إدارة
                        </a>
                        <div>
                         الأعضاء ({{ $group->users->count() }})
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>