<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Servicing;

class ViewHomePages extends Component
{
    /*
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    // public function render()
    // {
    //     $rabbits = Servicing::where('actual_date_of_birth', '!=', null)->latest()->get();

    //     return view('livewire.home.index', )->extends('layouts.app');
    // }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.home.index', [
            'rabbits' => Servicing::where('actual_date_of_birth', '!=', null)->latest()->get(),
        ])->extends('layouts.app');
    }
}
