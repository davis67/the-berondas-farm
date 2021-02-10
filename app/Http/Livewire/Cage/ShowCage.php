<?php

namespace App\Http\Livewire\Cage;

use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;

class ShowCage extends Component
{
    /**
     * The cage instance.
     *
     * @var mixed
     */
    public $cage;

    /**
     * The selected rabbit instance.
     *
     * @var mixed
     */
    public $selectRabbit;

    /**
     * Indicates if rabbit transfer is being confirmed.
     *
     * @var bool
     */
    public $confirmingRabbitTransfer = false;

    /**
     * The rabbit id.
     *
     * @var int
     */
    public $rabbit;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(Cage $cage)
    {
        $this->cage = $cage->loadMissing('rabbits');
    }

    /**
     * Validate the transfer of the rabbit from one cage to another.
     *
     * @return void
     */
    public function validateTransfer()
    {
        $this->validate([
            'rabbit' => ['required'],
        ]);

        $this->confirmingRabbitTransfer = true;
    }

    /**
     * Handler the transfer of the rabbit from one cage to another.
     *
     * @return void
     */
    public function handleTransfer()
    {
        $this->cage->transferRabbit($this->rabbit);

        $transferedRabbit = Rabbit::findOrFail($this->rabbit);

        $this->rabbit->update([
            'cage_id' => $this->cage->id,
        ]);

        $this->confirmingRabbitTransfer = false;

        $this->rabbit = '';

        session()->flash('success', 'Cage Info successfully updated.');

        return redirect(route('cages.show', $this->cage->id));
    }

    /**
     * Updating the rabbit instance.
     *
     * @return void
     */
    public function updatingRabbit($value)
    {
        if (! empty($value)) {
            $this->selectRabbit = Rabbit::findOrFail($value);
        }
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.cage.show-cage', [
            'rabbits' => Rabbit::latest()->get(),
        ])->extends('layouts.app');
    }
}
