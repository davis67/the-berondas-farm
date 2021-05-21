<?php

namespace App\Auth;

use App\Api\ApiToken;
use App\Interfaces\Sluggable;
use Illuminate\Support\Collection;
use Database\Factories\UserFactory;
use App\Entities\Tools\SlugGenerator;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Sluggable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'email_confirmed',
		'slug',
		'external_id',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'last_activity_at' => 'datetime'
	];

	/**
 * Create a new factory instance for the model.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
	protected static function newFactory()
	{
		return UserFactory::new();
	}

	/**
	 * Get the API tokens assigned to this user.
	 */
	public function apiTokens() : HasMany
	{
		return $this->hasMany(ApiToken::class);
	}

	/**
	* Check if the user is the default public user.
	*/
	public function isDefault(): bool
	{
		return $this->system_name === 'public';
	}

	/**
	 * Get the last activity time for this user.
	 */
	public function scopeWithLastActivityAt(Builder $query)
	{
		$query->addSelect(['activities.created_at as last_activity_at'])
			->leftJoinSub(function (\Illuminate\Database\Query\Builder $query) {
				$query->from('activities')->select('user_id')
					->selectRaw('max(created_at) as created_at')
					->groupBy('user_id');
			}, 'activities', 'users.id', '=', 'activities.user_id');
	}

	public function getDefaultPermissionsAttribute()
	{
		return $this->permissions();
	}

	/**
	 * {@inheritDoc}
	 */
	public function refreshSlug() : string
	{
		$this->slug = app(SlugGenerator::class)->generate($this);

		return $this->slug;
	}

	/**
	* Returns a URL to the user's avatar
	*/
	public function getAvatar(int $size = 50): string
	{
		$default = url('/user_avatar.png');
		$imageId = $this->image_id;
		if ($imageId === 0 || $imageId === '0' || $imageId === null) {
			return $default;
		}

		try {
			$avatar = $this->avatar ? url($this->avatar->getThumb($size, $size, false)) : $default;
		} catch (\Exception $err) {
			$avatar = $default;
		}
		return $avatar;
	}

	/**
	* Get a shortened version of the user's name.
	*/
	public function getShortName(int $chars = 8): string
	{
		if (mb_strlen($this->name) <= $chars) {
			return $this->name;
		}

		$splitName = explode(' ', $this->name);
		if (mb_strlen($splitName[0]) <= $chars) {
			return $splitName[0];
		}

		return '';
	}

	/**
	 * Get the url for editing this user.
	 */
	public function getEditUrl(string $path = ''): string
	{
		$uri = '/settings/users/' . $this->id . '/' . trim($path, '/');
		return url(rtrim($uri, '/'));
	}

	/**
	* Get the url that links to this user's profile.
	*/
	public function getProfileUrl(): string
	{
		return url('/user/' . $this->slug);
	}

	/**
	 * The roles that belong to the user.
	 * @return BelongsToMany
	 */
	public function roles()
	{
		if ($this->id === 0) {
			return ;
		}
		return $this->belongsToMany(Role::class);
	}

	/**
	 * Check if the user has a role.
	 */
	public function hasRole($roleId): bool
	{
		return $this->roles->pluck('id')->contains($roleId);
	}

	/**
	 * Check if the user has a role.
	 */
	public function hasSystemRole(string $roleSystemName): bool
	{
		return $this->roles->pluck('system_name')->contains($roleSystemName);
	}

	/**
	 * Attach the default system role to this user.
	 */
	public function attachDefaultRole(): void
	{
		$roleId = setting('registration-role');
		if ($roleId && $this->roles()->where('id', '=', $roleId)->count() === 0) {
			$this->roles()->attach($roleId);
		}
	}

	/**
	 * Check if the user has a particular permission.
	 */
	public function can($abilities, $arguments = []): bool
	{
		if ($this->email === 'guest') {
			return false;
		}

		return $this->permissions()->contains($abilities);
	}

	/**
	 * Get all permissions belonging to a the current user.
	 */
	protected function permissions(): Collection
	{
		// if (isset($this->permissions)) {
		// 	return $this->permissions;
		// }

		$this->permissions = $this->newQuery()->getConnection()->table('role_user', 'ru')
			->select('role_permissions.name as name')->distinct()
			->leftJoin('permission_role', 'ru.role_id', '=', 'permission_role.role_id')
			->leftJoin('role_permissions', 'permission_role.permission_id', '=', 'role_permissions.id')
			->where('ru.user_id', '=', $this->id)
			->get()
			->pluck('name');

		return $this->permissions;
	}

	/**
	 * Clear any cached permissions on this instance.
	 */
	public function clearPermissionCache()
	{
		$this->permissions = null;
	}

	/**
	 * Attach a role to this user.
	 */
	public function attachRole(Role $role)
	{
		$this->roles()->attach($role->id);
	}
}
