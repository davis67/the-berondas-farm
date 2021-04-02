<?php

namespace App\Http\Livewire;

use App\Models\Rabbit;
use Livewire\Component;
use App\Models\Servicing;

class ViewHomePage extends Component
{
    public function render()
    {
        $rabbits = Servicing::where('actual_date_of_birth', '=', null)->latest()->get();

        // dd($rabbits);

        return view('livewire.view-home-page', [
            'rabbits' => Servicing::where('actual_date_of_birth', '=', null)->latest()->get(),
            'total_rabbits' => Rabbit::count(),
            'total_kits' => Rabbit::where('gender', '=', null)->count(),
            'total_female' => Rabbit::where('gender', '=', 'female')->count(),
            'total_male' => Rabbit::where('gender', '=', 'male')->count(),
        ])->extends('layouts.app');
    }
}
