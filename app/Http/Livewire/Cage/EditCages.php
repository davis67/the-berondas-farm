<?php

namespace App\Http\Livewire\Cage;

use App\Models\Cage;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditCages extends Component
{
    /**
     * Name.
     *
     * @var string
     */
    public $cage_no;

    /**
     * Instance of Breed Type.
     *
     * @var mixed
     */
    public $cage;

    /**
     * Indicates if cage deletion is being confirmed.
     *
     * @var bool [<description>]
     */
    public $confirmingCageDeletion = false;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(Cage $cage)
    {
        $this->cage = $cage;
        $this->cage_no = $cage->cage_no;
    }

    /**
     * Update the Cage.
     *
     * @return void
     */
    public function updateCage()
    {
        $data = $this->validate([
            'cage_no' => ['required', Rule::unique('cages')->ignore($this->cage->id)],
        ]);

        $this->confirmingCageDeletion = true;

        $this->cage->update([
            'cage_no' => strtoupper($this->cage_no),
        ]);

        session()->flash('success', 'You have successfully updated a cage.');

        return redirect(route('cages.show', $this->cage->id));
    }

    /**
     * Confirm the deletion of the Expense breed.
     *
     * @return void
     */
    public function confirmingDeletion()
    {
        $this->confirmingCageDeletion = true;
    }

    /**
     * Close the confirmation modal of the deletion of the Expense breed.
     *
     * @return void
     */
    public function closeConfirmingDeletion()
    {
        $this->confirmingCageDeletion = false;
    }

    /**
     * Confirm the deletion of the Cage.
     *
     * @return void
     */
    public function deleteCage()
    {
        $this->cage->delete();

        $this->confirmingCageDeletion = false;

        session()->flash('success', 'You have successfully deleted a cage.');

        return redirect(route('batches.show', $this->cage->batch_id));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.cage.edit-cages');
    }
}
