<div>

    <x-dialog-modal wire:model.live="mostrarModal">
        <x-slot name="title">Eliminar</x-slot>
        <x-slot name="content">¿Estás seguro que quieres eliminar?</x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">Cancelar</x-secondary-button>
            <x-danger-button class="ms-3" wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">Confirmar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>