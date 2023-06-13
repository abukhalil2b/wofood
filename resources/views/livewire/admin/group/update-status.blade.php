<div class="flex gap-3">
    <div wire:click="active" class="option {{ $status == 1 ? 'option-selected' : '' }}">
        مغعل
    </div>
    <div wire:click="deactive" class="option {{ $status == 0 ? 'option-selected' : '' }}">
        معطل
    </div>
</div>