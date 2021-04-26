<x-modal.dialog wire:model.defer="showSaveModal">
    <x-slot name="title">Save a Rabbit</x-slot>
    <x-slot name="content">
        <x-input.group for="rabbit_no"
                       :error="$errors->first('rabbit.rabbit_no')"
                       label="Rabbit No">
            <x-input.text wire:model="rabbit.rabbit_no"
                          id="rabbit_no" />
        </x-input.group>
        <x-input.group for="gender"
                       :error="$errors->first('rabbit.gender')"
                       label="Gender">
            <x-input.select wire:model="rabbit.gender"
                            id="gender">
                <option value="">Select Gender ...</option>
                @foreach (App\Models\Rabbit::GENDER as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
        <x-input.group for="cage_id"
                       :error="$errors->first('rabbit.cage_id')"
                       label="Cage">
            <x-input.select wire:model="rabbit.cage_id"
                            id="cage_id">
                <option value="">Select Cage ...</option>
                @foreach ($cages as $cage)
                    <option value="{{ $cage->id }}">{{ $cage->cage_no }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group for="breed_id"
                       :error="$errors->first('rabbit.breed_id')"
                       label="Breed Types">
            <x-input.select wire:model="rabbit.breed_id"
                            id="breed_id">
                <option value="">Select Breed Types ...</option>
                @foreach ($rabbitTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
        <x-input.group for="date_of_birth"
                       :error="$errors->first('rabbit.date_of_birth')"
                       label="Date Of Birth">
            <input type="date"
                   wire:model="rabbit.date_of_birth"
                   id="date_of_birth" />
        </x-input.group>
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary type="button"
                            class="bg-red-600"
                            wire:click="$set('showSaveModal', false)">Cancel</x-button.secondary>
        <x-button.primary type="submit">Save</x-button.primary>
    </x-slot>
</x-modal.dialog>
