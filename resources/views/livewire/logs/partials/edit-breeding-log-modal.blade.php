<x-modal.dialog wire:model.defer="showEditLogModal">
    <x-slot name="title">Edit Log Information for {{ $log->sire->rabbit_no }}</x-slot>
    <x-slot name="content">
        <x-input.group for="dam_id" :error="$errors->first('breedLog.dam_id')" label="Dam">
            <x-input.select wire:model="breedLog.cage_id" id="dam_id">
                <option value="">Select Male ...</option>
                @foreach (App\Models\Rabbit::where('gender', 'dam')->get() as $rabbit)
                    <option value="{{ $rabbit->id }}">{{ $rabbit->rabbit_no }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group for="litters" :error="$errors->first('breedLog.litters')" label="Total litters">
            <x-input.text wire:model="breedLog.litters" id="litters" />
        </x-input.group>
        <x-input.group for="dead_litters" :error="$errors->first('breedLog.dead_litters')" label="Dead Litters">
            <x-input.text wire:model="breedLog.dead_litters" id="dead_litters" />
        </x-input.group>

        <x-input.group for="date_of_mating" :error="$errors->first('rabbit.date_of_mating')" label="Date of Mating">
            <input type="date" wire:model="rabbit.date_of_mating" id="date_of_mating" />
        </x-input.group>
        <x-input.group for="kiddle_date" :error="$errors->first('rabbit.kiddle_date')" label="Kiddle Date">
            <input type="date" wire:model="rabbit.kiddle_date" id="kiddle_date" />
        </x-input.group>
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary type="button" class="bg-red-600" wire:click="$set('showSaveModal', false)">Cancel</x-button.secondary>
        <x-button.primary type="submit">Save</x-button.primary>
    </x-slot>
</x-modal.dialog>
