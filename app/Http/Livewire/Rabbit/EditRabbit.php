<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;
use App\Models\BreedType;
use Illuminate\Validation\Rule;

class EditRabbit extends Component
{
    /**
     * The Instance of Rabbit.
     *
     * @var mixed
     */
    public $rabbit;

    /**
     * The Instance of Breed.
     *
     * @var mixed
     */
    public $breed_id;

    /**
     * Rabbit No.
     *
     * @var string
     */
    public $rabbit_no;

    /**
     * Cage.
     *
     * @var string
     */
    public $cage_id;

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

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(Rabbit $rabbit)
    {
        $this->rabbit = $rabbit;
        $this->rabbit_no = $rabbit->rabbit_no;
        $this->status = $rabbit->status;
        $this->cage_id = $rabbit->cage_id;
        $this->date_of_birth = $rabbit->date_of_birth;
        $this->gender = $rabbit->gender;
        $this->breed_id = $rabbit->breed_id;
    }

    /**
     * Update the Rabbit Types.
     *
     * @return void
     */
    public function updateRabbit()
    {
        $this->validate([
            'breed_id' => ['nullable'],
            'rabbit_no' => ['required', Rule::unique('rabbits')->ignore($this->rabbit->id)],
            'cage_id' => ['required'],
            'status' => ['required'],
            'date_of_birth' => ['nullable'],
            'gender' => ['required'],
        ]);

        $this->rabbit->update([
            'breed_id' => $this->breed_id,
            'rabbit_no' => $this->rabbit_no,
            'date_of_birth' => $this->date_of_birth,
            'cage_id' => $this->cage_id,
            'status' => $this->status,
            'gender' => $this->gender,
            'farm_id' => auth()->user()->farm_id,
        ]);

        session()->flash('success', 'You have successfully updated a rabbit.');

        return redirect(route('rabbits.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.edit-rabbit', [
            'breeds' => BreedType::all(),
            'cages' => Cage::all(),
        ]);
    }
}
