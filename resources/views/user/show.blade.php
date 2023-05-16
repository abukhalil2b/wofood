<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white mt-1 p-1 text-gray-800 border rounded">
                <div>{{ $user->name }}</div>
                <div>{{ $user->phone }}</div>
            </div>

            <div class="mt-1">

                <livewire:user.task-index :user="$user" />

            </div>
        </div>
        
    </div>

</x-app-layout>