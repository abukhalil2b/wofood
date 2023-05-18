<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        @include('inc._super_admin_nav')

        @include('inc._modal_new_day')

        <div class="mt-1">
            @foreach($days as $day)
            <a href="{{ route('super_admin.day.show',$day->id) }}" class="block p-1 mt-1 bg-white border rounded">
                <div class="p-1 text-gray-800 flex justify-between">
                    <div>
                        <span class="text-red-800">{{ $day->title }}</span>
                        {{ $day->ar_date }}
                    </div>

                    <div class="text-xs text-gray-400">{{ $day->en_date }}</div>
                </div>

            </a>

            @endforeach
        </div>

    </div>


</x-app-layout>