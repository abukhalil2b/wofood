<div>

    <div wire:click="toggleDone" class="cursor-pointer">
        <x-done-at-mark done_at="{{ $done_at == null ? false : true }}" />
    </div>

</div>