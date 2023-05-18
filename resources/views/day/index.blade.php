<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="gap-2 grid grid-cols-1 sm:grid-cols-4 md:grid-cols-6">

            @foreach($days as $day)
            <a class="card" href="{{ route('day.show',$day->id) }}">
                @include('inc._day')
            </a>
            @endforeach


        </div>

    </div>

</x-app-layout>