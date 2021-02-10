<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Rabbit;
use Livewire\Component;

class AddRabbit extends Component
{
    public $breed;

    public $date_of_birth;

    public $gender;

    public $status;

    public function addRabbit()
    {
        $this->validate([
            'breed' => ['required'],
            'date_of_birth' => ['required'],
            'status' => ['required'],
            'gender' => ['required'],
        ]);

        Rabbit::create([
            'breed' => $this->breed,
            'date_of_birth' => $this->date_of_birth,
            'status' => $this->status,
            'gender' => $this->gender,
            'farm_id' => auth()->user()->farm_id,
        ]);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.add-rabbit');
    }
}
