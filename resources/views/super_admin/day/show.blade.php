<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-3">
        @include('inc._super_admin_nav')

        <div class="mt-1">
            <div class="text-xl text-orange-500 text-center">
                {{ $day->title }}
            </div>

            <div class="text-xl text-center">
                {{ $day->ar_date }}
            </div>


            <div class="text-xl text-center">
                {{ $day->en_date }}
            </div>

        </div>

        <div class="mt-3">
            @include('inc._modal_edit_day')
        </div>

</x-app-layout>