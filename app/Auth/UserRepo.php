<?php

namespace App\Auth;

use App\Models\Action\Activity;
use App\Exceptions\NotFoundException;
use App\Exceptions\UserUpdateException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepo
{
	/**
	 * UserRepo constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * Get a user by their email address.
	 */
	public function getByEmail(string $email): ?User
	{
		return User::query()->where('email', '=', $email)->first();
	}

	/**
	 * Get a user by their ID.
	 */
	public function getById(int $id): User
	{
		return User::query()->findOrFail($id);
	}

	/**
	 * Get a user by their slug.
	 */
	public function getBySlug(string $slug): User
	{
		return User::query()->where('slug', '=', $slug)->firstOrFail();
	}

	/**
	 * Get all the users with their permissions.
	 */
	public function getAllUsers(): Collection
	{
		return User::query()->with('roles', 'avatar')->orderBy('name', 'asc')->get();
	}

	/**
	 * Get all the users with their permissions in a paginated format.
	 */
	public function getAllUsersPaginatedAndSorted(int $count, array $sortData): LengthAwarePaginator
	{
		$sort = $sortData['sort'];

		$query = User::query()->select(['*'])
			// ->withLastActivityAt()
			->with(['roles'])
			// ->with(['roles', 'avatar'])
			->orderBy($sort, $sortData['order']);

		if ($sortData['search']) {
			$term = '%' . $sortData['search'] . '%';
			$query->where(function ($query) use ($term) {
				$query->where('name', 'like', $term)
					->orWhere('email', 'like', $term);
			});
		}

		return $query->paginate($count);
	}

	/**
	* Creates a new user and attaches a role to them.
	*/
	public function registerNew(array $data, bool $emailConfirmed = false): User
	{
		$user = $this->create($data, $emailConfirmed);
		$user->attachDefaultRole();
		// $this->downloadAndAssignUserAvatar($user);

		return $user;
	}

	/**
	 * Assign a user to a system-level role.
	 * @throws NotFoundException
	 */
	public function attachSystemRole(User $user, string $systemRoleName)
	{
		$role = Role::getSystemRole($systemRoleName);
		if (is_null($role)) {
			throw new NotFoundException("Role '{$systemRoleName}' not found");
		}
		$user->attachRole($role);
	}

	/**
	 * Checks if the give user is the only admin.
	 */
	public function isOnlyAdmin(User $user): bool
	{
		if (!$user->hasSystemRole('admin')) {
			return false;
		}

		$adminRole = Role::getSystemRole('admin');
		if ($adminRole->users()->count() > 1) {
			return false;
		}

		return true;
	}

	/**
	 * Set the assigned user roles via an array of role IDs.
	 * @throws UserUpdateException
	 */
	public function setUserRoles(User $user, array $roles)
	{
		if ($this->demotingLastAdmin($user, $roles)) {
			throw new UserUpdateException(trans('errors.role_cannot_remove_only_admin'), $user->getEditUrl());
		}

		$user->roles()->sync($roles);
	}

	/**
	 * Check if the given user is the last admin and their new roles no longer
	 * contains the admin role.
	 */
	protected function demotingLastAdmin(User $user, array $newRoles) : bool
	{
		if ($this->isOnlyAdmin($user)) {
			$adminRole = Role::getSystemRole('admin');
			if (!in_array(strval($adminRole->id), $newRoles)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Create a new basic instance of user.
	 */
	public function create(array $data, bool $emailConfirmed = false): User
	{
		$details = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'email_confirmed' => $emailConfirmed,
			'external_auth_id' => $data['external_auth_id'] ?? '',
		];

		$user = new User();
		$user->forceFill($details);
		$user->refreshSlug();
		$user->save();

		return $user;
	}

	/**
	 * Get the latest activity for a user.
	 */
	public function getActivity(User $user, int $count = 20, int $page = 0): array
	{
		return Activity::userActivity($user, $count, $page);
	}

	/**
	 * Get the roles in the system that are assignable to a user.
	 */
	public function getAllRoles(): Collection
	{
		return Role::query()->orderBy('display_name', 'asc')->get();
	}
}
