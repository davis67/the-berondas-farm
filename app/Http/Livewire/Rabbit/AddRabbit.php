<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Rabbit;
use Livewire\Component;

class AddRabbit extends Component
{
    /**
     * The Instance of Breed.
     *
     * @var mixed
     */
    public $breed;

    /**
     * Date of Birth.
     *
     * @var date
     */
    public $date_of_birth;

    /**
     * Gender.
     *
     * @var string
     */
    public $gender;

    /**
     * Status.
     *
     * @var string
     */
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
        return view('livewire.rabbit.add-rabbit', [
            'breeds' => BreedType::all(),
        ]);
    }
}
