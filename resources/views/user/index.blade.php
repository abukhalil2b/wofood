<x-app-layout>

    <div class="p-3">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-xs"> قائمة الأعضاء الذين تحت إشراف مشرف الوفد</div>
            <form action="{{ route('user.search') }}" method="POST" class="mt-3 flex gap-1 justify-center items-center">
                @csrf
                <x-text-input class="w-full" type="search" name="search" placeholder="البحث بالاسم"/>
                <x-primary-button class="w-16">
                    بحث
                </x-primary-button>
            </form>
            <div class="mt-1">
            
                @foreach($users as $user)
                <div class="bg-white mt-1 p-1 text-gray-800 border rounded">
                    <a href="{{ route('user.day.index',$user->id) }}" >

                        <div>
                        {{ $user->name }}
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