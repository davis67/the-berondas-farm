<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Servicing;

class Dashboard extends Component
{
    public function render()
    {
        //error here
        return view('livewire.dashboard', [
            'rabbits' => Servicing::where('actual_date_of_birth', '!=', null)->get(),
            'total_rabbits' => 0,
            'total_kits' => 0,
        ])->extends('layouts.app');
    }
}
