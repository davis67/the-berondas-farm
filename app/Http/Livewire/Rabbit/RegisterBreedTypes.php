<?php

namespace App\Http\Livewire\Rabbit;

use Livewire\Component;
use App\Models\BreedType;

class RegisterBreedTypes extends Component
{
    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Description.
     *
     * @var string
     */
    public $description;

    /**
     * Add the Rabbit Types.
     *
     * @return void
     */
    public function addBreedTypes()
    {
        $data = $this->validate([
            'name' => 'required|unique:breed_types',
            'description' => 'nullable',
        ]);

        BreedType::create([
            'name' => mb_strtolower($this->name),
            'description' => mb_strtolower($this->description),
        ]);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.register-breed-types');
    }
}
