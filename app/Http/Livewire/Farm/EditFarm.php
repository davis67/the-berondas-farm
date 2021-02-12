<?php

namespace App\Http\Livewire\Farm;

use App\Models\Farm;
use Livewire\Component;

class EditFarm extends Component
{
    /**
     * Farm Istance.
     *
     * @var mixed
     */
    public $farm;

    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Contacts.
     *
     * @var string
     */
    public $contacts;

    /**
     * Address.
     *
     * @var string
     */
    public $address;

    /**
     * Is active.
     *
     * @var bool
     */
    public $is_active;

    /**
     * Mount the component.
     *
     * @param mixed $farm
     *
     * @return void
     */
    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->name = $farm->name;
        $this->contacts = $farm->contacts;
        $this->address = $farm->address;
        $this->is_active = $farm->is_active;
    }

    /**
     * Updating the Farm resource.
     *
     * @return void
     */
    public function updateFarm()
    {
        $data = $this->validate([
            'name' => ['required'],
            'contacts' => ['required'],
            'address' => ['required'],
            'is_active' => ['nullable'],
        ]);

        // dd($data);

        $this->farm->update($data);

        session()->flash('success', 'Farm Info successfully Udated.');

        return redirect(route('farms.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.farm.edit-farm')->extends('layouts.app');
    }
}
