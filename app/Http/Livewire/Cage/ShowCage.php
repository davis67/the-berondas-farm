<?php

namespace App\Http\Livewire\Cage;

use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;

class ShowCage extends Component
{
    public $cage;

    public $rabbit;

    public function mount(Cage $cage)
    {
        $this->cage = $cage;
    }

    public function handleTransfer()
    {
        $this->validate([
            'rabbit' => ['required'],
        ]);
        $this->cage->rabbits()->attach($this->rabbit, [
            'date_of_transfer' => now(),
        ]);
    }

    public function render()
    {
        return view('livewire.cage.show-cage', [
            'rabbits' => Rabbit::all(),
        ])->extends('layouts.app');
    }
}
