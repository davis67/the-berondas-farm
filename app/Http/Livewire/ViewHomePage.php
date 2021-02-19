<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicing;

class ViewHomePage extends Component
{
    public function render()
    {
        return view('livewire.view-home-page', [
            'rabbits' => Servicing::where('actual_date_of_birth', '!=', null)->latest()->get(),
        ])->extends('layouts.app');
    }
}
