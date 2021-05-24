<?php

namespace App\Http\Controllers;

use App\Auth\Role;
use Illuminate\Http\Request;
use App\Exceptions\PermissionsException;
use App\Auth\Permissions\PermissionsRepo;

class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('roles.index', ['roles' => Role::all()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'display_name' => 'required|min:3|max:180',
			'description' => 'max:180'
		]);

		app(PermissionsRepo::class)->saveNewRole($request->all());

		session()->flash('success', 'Role successfully Added.');

		return redirect(route('roles.index'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role = app(PermissionsRepo::class)->getRoleById($id);

		return view('roles.edit', ['role' => $role]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'display_name' => 'required|min:3|max:180',
			'description' => 'max:180'
		]);

		app(PermissionsRepo::class)->updateRole($id, $request->all());
		return redirect(route('settings.index'));
	}

	/**
	 * Show the view to delete a role.
	 * Offers the chance to migrate users.
	 */
	public function showDelete(string $id)
	{
		$role = app(PermissionsRepo::class)->getRoleById($id);
		$roles = app(PermissionsRepo::class)->getAllRolesExcept($role);
		$blankRole = $role->newInstance(['display_name' => trans('settings.role_delete_no_migration')]);
		$roles->prepend($blankRole);
		return view('roles.delete', ['role' => $role, 'roles' => $roles]);
	}

	/**

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id)
	{
		try {
			app(PermissionsRepo::class)->deleteRole($id, $request->get('migrate_role_id'));
		} catch (PermissionsException $e) {
			return redirect()->back();
		}

		return redirect('/settings/roles');
	}
}
