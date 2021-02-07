<?php

namespace App\Http\Livewire\Cage;

use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;

class ShowCage extends Component
{
    public $cage;

    public $selectRabbit;

    public $rabbit;

    public function mount(Cage $cage)
    {
        $this->cage = $cage->loadMissing('rabbits');
    }

    public function updated()
    {
        $this->cage->fresh();
    }

    public function handleTransfer()
    {
        $this->validate([
            'rabbit' => ['required'],
        ]);
        $this->cage->rabbits()->attach($this->rabbit, [
            'date_of_transfer' => now(),
            'is_occupant' => true,
        ]);

        session()->flash('success', 'Cage Info successfully updated.');
    }

    public function updatingRabbit($value)
    {
        if (! empty($value)) {
            $this->selectRabbit = Rabbit::findOrFail($value);
        }
    }

    public function render()
    {
        return view('livewire.cage.show-cage', [
            'rabbits' => Rabbit::all(),
        ])->extends('layouts.app');
    }
}
