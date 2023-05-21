<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

       @include('inc._username')
    
        <div class="mt-1 card2 flex-col">

            <div class=""> {{ $day->ar_date }} </div>
            <div class="text-[#ffb031]"> {{ $day->title }} </div>
            <div class="text-xs text-gray-400"> {{ $day->en_date }} </div>

        </div>

        @if(auth()->id() != $user->id)
        @include('inc._modal_new_task_for_my_team')
        @endif
      
        @foreach($tasks as $task)

        @include('inc._task')

        @endforeach
    </div>

</x-app-layout>