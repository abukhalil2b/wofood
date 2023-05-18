<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        @foreach($subtasks as $subtask)
        <div class="card">
            {{ $subtask->title}}
        </div>
        @endforeach

    </div>

</x-app-layout>