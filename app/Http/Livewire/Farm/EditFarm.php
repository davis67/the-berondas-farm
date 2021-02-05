<?php

namespace App\Http\Livewire\Farm;

use App\Models\Farm;
use Livewire\Component;

class EditFarm extends Component
{
    /**
     * @var
     */
    public $farm;

    public $name;

    public $contacts;

    public $address;

    public $is_active;

    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->name = $farm->name;
        $this->contacts = $farm->contacts;
        $this->address = $farm->address;
        $this->is_active = $farm->is_active;
    }

    public function updateFarm()
    {
        $this->validate([
            'name' => ['required'],
            'contacts' => ['required'],
            'address' => ['required'],
        ]);

        $data = [
            'name' => $this->name,
            'contacts' => $this->contacts,
            'address' => $this->address,
            'is_active' => (bool) $this->is_active,
         ];

        $this->farm->update($data);
    }

    public function render()
    {
        return view('livewire.farm.edit-farm')->extends('layouts.app');
    }
}
