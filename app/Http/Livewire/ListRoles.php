<?php

namespace App\Http\Livewire;

use App\Auth\Role;
use Livewire\Component;

class ListRoles extends Component
{
	public function render()
	{
		return view('livewire.list-roles', ['roles' => Role::all()]);
	}
}
