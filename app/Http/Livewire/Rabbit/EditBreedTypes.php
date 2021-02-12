<?php

namespace App\Http\Livewire\Rabbit;

use Livewire\Component;
use App\Models\BreedType;
use Illuminate\Validation\Rule;

class EditBreedTypes extends Component
{
    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Instance of Breed Type.
     *
     * @var string
     */
    public $breedType;

    /**
     * Description.
     *
     * @var string
     */
    public $description;

    /**
     * Indicates if breed deletion is being confirmed.
     *
     * @var bool [<description>]
     */
    public $confirmingRabbitDeletion = false;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(BreedType $breedType)
    {
        $this->breedType = $breedType;
        $this->name = $breedType->name;
        $this->description = $breedType->description;
    }

    /**
     * Add the Rabbit Types.
     *
     * @return void
     */
    public function updateBreedTypes()
    {
        $data = $this->validate([
            'name' => ['required', Rule::unique('breed_types')->ignore($this->breedType->id)],
            'description' => 'nullable',
        ]);

        $this->confirmingRabbitDeletion = true;

        $this->breedType->update([
            'name' => mb_strtolower($this->name),
            'description' => mb_strtolower($this->description),
        ]);

        session()->flash('success', 'You have successfully updated a breedType.');

        return redirect(route('breed-types.index'));
    }

    /**
     * Confirm the deletion of the rabbit breed.
     *
     * @return void
     */
    public function confirmingDeletion()
    {
        $this->confirmingRabbitDeletion = true;
    }

    /**
     * Close the confirmation modal of the deletion of the rabbit breed.
     *
     * @return void
     */
    public function closeConfirmingDeletion()
    {
        $this->confirmingRabbitDeletion = false;
    }

    /**
     * Confirm the deletion of the rabbit breed.
     *
     * @return void
     */
    public function deleteBreed()
    {
        $this->breedType->delete();

        $this->confirmingRabbitDeletion = false;

        session()->flash('success', 'You have successfully deleted a breedType.');

        return redirect(route('breed-types.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.edit-breed-types');
    }
}
