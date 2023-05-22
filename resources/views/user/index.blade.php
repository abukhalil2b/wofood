<x-app-layout>

    <div class="p-3">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-xs"> 
{{ $title }}
            </div>

            <form action="{{ route('user.search') }}" method="POST" class="mt-3 flex gap-1 justify-center items-center">
                @csrf
                <x-text-input class="w-full card2" type="search" name="search" placeholder="البحث بالاسم"/>
                <x-primary-button class="w-16">
                    بحث
                </x-primary-button>
            </form>

            <div class="mt-1">
            
                @foreach($users as $user)
                <div class="card2">
                    <a href="{{ route('user.day.index',$user->id) }}" >
                        <div>
                        {{ $user->name }}
                        <div class="text-xs text-[#032a38]">
                        {{ $user->group->title }}
                        </div>
                        </div>
                        <div class="text-xs text-gray-400">
                        الهاتف: {{ $user->phone }}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>