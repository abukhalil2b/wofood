<x-app-layout>

    <div class="mt-1 max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
{{ $group->title }}
        @include('inc._modal_new_taskcat')

        <div class="mt-1">

            @foreach($taskcats as $taskcat)

            <div  class="block p-1 mt-1 bg-white border rounded">

                <div class="p-1 text-gray-800 flex justify-between">
                    <div class="text-red-800">

                       {{ $taskcat->title }} 
                       
                    </div>  
                </div>

            </div>

            @endforeach
        </div>

    </div>


</x-app-layout>