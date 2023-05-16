<x-app-layout>

    <div x-data="{ show:'todayTasks' }" class="mt-1 max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
  
        <div class="card flex justify-between text-xs">
            <div @click="show = 'totalTasks' " class="option" :class=" show == 'totalTasks' ? 'option-selected' : '' ">
                كل المهام ({{ count( $totalTasks ) }})
            </div>

            <div @click="show = 'todayTasks' " class="option" :class=" show == 'todayTasks' ? 'option-selected' : '' ">
                 اليوم ({{ count( $todayTasks ) }})
            </div>

            <div @click="show = 'prevTasks' " class="option" :class=" show == 'prevTasks' ? 'option-selected' : '' ">
                 السابقة ({{ count( $prevTasks ) }})
            </div>

            <div @click="show = 'nextTasks' " class="option" :class=" show == 'nextTasks' ? 'option-selected' : '' ">
                 القادمة ({{ count( $nextTasks ) }})
            </div>

        </div>

        @include('task._modal_new_task')

        <div x-cloak x-show=" show == 'totalTasks' ">
            @include('task._total_task')
        </div>

        <div x-cloak x-show=" show == 'todayTasks' ">
            @include('task._today_task')
        </div>

        <div x-cloak x-show=" show == 'prevTasks' ">
            @include('task._prev_task')
        </div>

        <div x-cloak x-show=" show == 'nextTasks' ">
            @include('task._next_task')
        </div>

    </div>

</x-app-layout>