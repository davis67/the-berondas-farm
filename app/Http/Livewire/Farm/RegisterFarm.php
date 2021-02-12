<?php

namespace App\Http\Livewire\Farm;

use App\Models\Farm;
use Livewire\Component;

class RegisterFarm extends Component
{
    public $name;

    public $contacts;

    public $address;

    public function registerFarm()
    {
        $this->validate([
            'name' => ['required'],
            'contacts' => ['required'],
            'address' => ['required'],
        ]);

        Farm::create([
            'name' => $this->name,
            'contacts' => $this->contacts,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Farm Info successfully added.');

        return redirect(route('farms.index'));
    }

    public function render()
    {
        return view('livewire.farm.register')->extends('layouts.app');
    }
}
