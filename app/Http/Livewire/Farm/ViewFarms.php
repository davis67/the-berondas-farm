<?php

namespace App\Http\Livewire\Farm;

use App\Models\Farm;
use Livewire\Component;

class ViewFarms extends Component
{
    public function render()
    {
        return view('livewire.farm.view-farms', [
            'farms' => Farm::all(),
        ])->extends('layouts.app');
    }
}
