<div>
   @foreach($tasks as $task)

   <div class="p-1 rounded border bg-white">
    {{ $task->title }}
    </div>

   @endforeach
</div>
