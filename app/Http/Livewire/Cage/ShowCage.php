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
     * Rules.
     *
     * @var array
     */
    protected $rules = [
        'rabbit' => 'required',
    ];

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
        //check for for the male rabbit and older than 4months old
        $validateRabbit = Rabbit::findOrFail($this->rabbit);
        if ($validateRabbit->isMale()) {
            //check if the age of the rabbits in the cage
            //validate
            //check if the rabbits are less than one month
            //validate
            $this->addError('rabbit', 'Something Here');
        }

        $this->validate();

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
            'rabbits' => Rabbit::all(),
        ])->extends('layouts.app');
    }
}
