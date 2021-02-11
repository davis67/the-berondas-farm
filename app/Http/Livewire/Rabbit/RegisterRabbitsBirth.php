<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Rabbit;
use Livewire\Component;
use App\Models\Servicing;

class RegisterRabbitsBirth extends Component
{
    /**
     * The Instance of service.
     *
     * @var mixed
     */
    public $service;

    /**
     * NUmber of rabbits.
     *
     * @var int
     */
    public $number_of_kits;

    /**
     * Actual Date of Birth.
     *
     * @var Date
     */
    public $actual_date_of_birth;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(Servicing $service)
    {
        $this->service = $service;
    }

    /**
     * Register a new birth.
     *
     * @var void
     */
    public function registerBirth()
    {
        $this->validate([
            'actual_date_of_birth' => ['required'],
            'number_of_kits' => ['required'],
        ]);

        $this->service->update([
            'actual_date_of_birth' => $this->actual_date_of_birth,
            'number_of_kits' => $this->number_of_kits,
        ]);

        $motherRabbit = findOrFail($this->service->mother_id);

        for ($count = 0; $count < $this->number_of_kits; ++$count) {
            Rabbit::create([
                'date_of_birth' => $this->actual_date_of_birth,
                'servicing_id' => $this->service->id,
                'cage_id' => $this->$motherRabbit->cage_id,
                'farm_id' => auth()->user()->farm_id,
            ]);
        }

        session()->flash('success', 'We have new kits in the farm.');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.register-rabbits-birth');
    }
}
