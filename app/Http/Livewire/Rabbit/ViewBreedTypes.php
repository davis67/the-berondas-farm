<?php

namespace App\Http\Livewire\Rabbit;

use Livewire\Component;
use App\Models\BreedType;

class ViewBreedTypes extends Component
{
    public function render()
    {
        return view('livewire.rabbit.view-breed-types', [
            'breed_types' => BreedType::all(),
        ]);
    }
}
