<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Rabbit;
use Livewire\Component;
use App\Models\BreedType;

class AddRabbit extends Component
{
    /**
     * The Instance of Breed.
     *
     * @var mixed
     */
    public $breed_id;

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
            'breed_id' => ['nullable'],
            'date_of_birth' => ['nullable'],
            'gender' => ['required'],
        ]);

        Rabbit::create([
            'breed_id' => $this->breed_id,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'farm_id' => auth()->user()->farm_id,
        ]);

        session()->flash('success', 'You have successfully updated a rabbit.');

        return redirect(route('home'));
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
