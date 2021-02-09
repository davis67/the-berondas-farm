<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Servicing;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'rabbits' => Servicing::all(),
        ])->extends('layouts.app');
    }
}
