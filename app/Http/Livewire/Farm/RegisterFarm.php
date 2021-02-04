<?php

namespace App\Http\Livewire\Farm;

use Livewire\Component;

class RegisterFarm extends Component
{
    public function render()
    {
        return view('livewire.farm.register')->extends('layouts.app');
    }
}
