<x-modal.dialog wire:model.defer="showDeleteModal">
    <x-slot name="title">Delete Log(s)</x-slot>
    <x-slot name="content">
        Are you sure you want to delete these Logs? This action is irreversible
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary class="bg-red-600"
                            wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
        <x-button.primary type="submit">Delete</x-button.primary>
    </x-slot>
</x-modal.dialog>
