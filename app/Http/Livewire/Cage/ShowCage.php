<?php

namespace App\Http\Livewire\Cage;

use App\Models\Cage;
use Livewire\Component;

class ShowCage extends Component
{
    public $cage;

    public $rabbit;

    public function mount(Cage $cage)
    {
        $this->cage = $cage;
    }

    public function render()
    {
        return view('livewire.cage.show-cage')->extends('layouts.app');
    }
}
