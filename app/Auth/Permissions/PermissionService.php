<?php

namespace App\Auth\Permissions;

use App\Auth\Role;
use App\Auth\User;
use Illuminate\Database\Connection;

class PermissionService
{
	/**
	 * @var ?array
	 */
	protected $userRoles = null;

	/**
	 * @var ?User
	 */
	protected $currentUserModel = null;

	/**
	 * @var Connection
	 */
	protected $db;

	/**
	 * @var array
	 */
	protected $entityCache;

	/**
	 * PermissionService constructor.
	 */
	public function __construct(Connection $db)
	{
		$this->db = $db;
	}

	/**
	 * Set the database connection
	 */
	public function setConnection(Connection $connection)
	{
		$this->db = $connection;
	}

	/**
	 * Prepare the local entity cache and ensure it's empty
	 * @param Entity[] $entities
	 */
	protected function readyEntityCache(array $entities = [])
	{
		$this->entityCache = [];

		foreach ($entities as $entity) {
			$class = get_class($entity);
			if (!isset($this->entityCache[$class])) {
				$this->entityCache[$class] = collect();
			}
			$this->entityCache[$class]->put($entity->id, $entity);
		}
	}

	/**
	 * Get the roles for the current logged in user.
	 */
	protected function getCurrentUserRoles(): array
	{
		if (!is_null($this->userRoles)) {
			return $this->userRoles;
		}

		if (auth()->guest()) {
			$this->userRoles = [Role::getSystemRole('public')->id];
		} else {
			$this->userRoles = $this->currentUser()->roles->pluck('id')->values()->all();
		}

		return $this->userRoles;
	}

	/**
	 * Get the current user
	 */
	private function currentUser(): User
	{
		if (is_null($this->currentUserModel)) {
			$this->currentUserModel = user();
		}

		return $this->currentUserModel;
	}

	/**
	 * Clean the cached user elements.
	 */
	private function clean(): void
	{
		$this->currentUserModel = null;
		$this->userRoles = null;
	}

	/**
	 * Build the entity jointPermissions for a particular role.
	 */
	public function buildJointPermissionForRole(Role $role)
	{
		$roles = [$role];
		$this->deleteManyJointPermissionsForRoles($roles);
	}

	/**
	 * Delete the entity jointPermissions attached to a particular role.
	 */
	public function deleteJointPermissionsForRole(Role $role)
	{
		$this->deleteManyJointPermissionsForRoles([$role]);
	}

	/**
	 * Delete all of the entity jointPermissions for a list of entities.
	 * @param Role[] $roles
	 */
	protected function deleteManyJointPermissionsForRoles($roles)
	{
		$roleIds = array_map(function ($role) {
			return $role->id;
		}, $roles);
		JointPermission::query()->whereIn('role_id', $roleIds)->delete();
	}
}
