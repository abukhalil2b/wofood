<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">

        <div class="w-full card2 p-3 ">

            <div class="text-[#032a38]"> 
                <span class="text-sm text-[#ffb031]">{{ $day->title }} </span>
                {{ $day->ar_date }} 
            </div>
         
            <div class="text-xs text-gray-400"> {{ $day->en_date }} </div>

        </div>
        @if( count($taskcats) )

        @include('inc._modal_new_task')

        @foreach($tasks as $task)

        @include('inc._task')

        @endforeach

        @else
<div>
    يجب اضافة تصنيف
</div>
        @endif
    </div>

</x-app-layout>