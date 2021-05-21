<?php

namespace App\Auth\Permissions;

use App\Auth\Role;
use App\Model;

/**
 * @property int $id
 */
class RolePermission extends Model
{
	/**
	 * The roles that belong to the permission.
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
	}

	/**
	 * Get the permission object by name.
	 * @param $name
	 * @return mixed
	 */
	public static function getByName($name)
	{
		return static::where('name', '=', $name)->first();
	}
}
