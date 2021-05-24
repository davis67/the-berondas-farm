<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Auth\Permissions\PermissionsRepo;

class AddRole extends Component
{
	/**
	 * Name.
	 *
	 * @var string
	 */
	public $display_name = '';

	/**
	 * Description.
	 *
	 * @var string
	 */
	public $description = '';

	/**
	 * system permissions.
	 *
	 * @var string
	 */
	public $systemPermissions = [
		'restrictions-manage-all' => false,
		'restrictions-manage-own' => false,
		'access-api' => false,
		'settings-manage' => false,
		'users-manage' => false,
		'user-roles-manage' => false
	];

	/**
	 * asset permissions.
	 *
	 * @var string
	 */
	public $assetPermissions = [
		'rabbit-create-all' => false,
		'rabbit-view-own' => false,
		'rabbit-view-all' => false,
		'rabbit-update-own' => false,
		'rabbit-update-all' => false,
		'rabbit-delete-own' => false,
		'rabbit-delete-all' => false,
		'expense-create-all' => false,
		'expense-view-own' => false,
		'expense-view-all' => false,
		'expense-update-own' => false,
		'expense-update-all' => false,
		'expense-delete-own' => false,
		'expense-delete-all' => false,
		'log-create-all' => false,
		'log-view-own' => false,
		'log-view-all' => false,
		'log-update-own' => false,
		'log-update-all' => false,
		'log-delete-own' => false,
		'log-delete-all' => false
	];

	protected $rules = [
		'display_name' => 'required|min:3|max:180',
		'description' => 'max:180'
	];

	protected function updatingSystemPermission($value)
	{
		dd('value', $value);
	}

	/**
	* Add a Role.
	*
	* @return void
	*/
	public function addNewRole()
	{
		dd($this->systemPermissions);
		// $this->validate();

		// app(PermissionsRepo::class)->saveNewRole($request->all());
	}

	/**
	 * Render the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view('livewire.add-role')->extends('layouts.app');
	}
}
