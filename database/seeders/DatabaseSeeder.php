<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\User;
use App\Models\Rabbit;
use App\Models\BreedingLog;
use App\Models\ExpenseType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();
		$farm = Farm::create([
			'name' => 'The Berondas Rabbitary',
			'contacts' => '0700000001',
			'address' => 'Kira-Bulindo',
		]);

		$user = User::create([
			'name' => 'Davis Agaba',
			'email' => 'admin@theberondasrabbitary.com',
			'email_verified_at' => now(),
			'password' => bcrypt('password'),
			'farm_id' => $farm->id,
			'remember_token' => Str::random(10),
		]);

		$expenseTypes = [
			['name' => 'Pellets', 'farm_id' => $farm->id],
			['name' => 'Cage Construction', 'farm_id' => $farm->id],
			['name' => 'Feeders', 'farm_id' => $farm->id],
			['name' => 'Nesting Boxes', 'farm_id' => $farm->id],
			['name' => 'Rabbit', 'farm_id' => $farm->id],
			['name' => 'Transport', 'farm_id' => $farm->id],
		];

		foreach ($expenseTypes as $ExpenseType) {
			ExpenseType::create($ExpenseType);
		}
		// Create default roles
		$admin = DB::table('roles')->insertGetId([
			'system_name' => 'admin',
			'display_name' => 'Admin',
			'description' => 'Administrator of the whole application',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
		]);
		$farmManager = DB::table('roles')->insertGetId([
			'system_name' => 'farm-manager',
			'display_name' => 'Farm Manger',
			'description' => 'User can edit Farm info, and Record Expenses',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
		]);

		// Get roles with permissions we need to change
		$adminRoleId = DB::table('roles')->where('system_name', '=', 'admin')->first()->id;
		$farmManagerRole = DB::table('roles')->where('system_name', '=', 'farm-manager')->first();

		// Create & attach new admin permissions
		$permissionsToCreate = [
			'settings-manage' => 'Manage Settings',
			'users-manage' => 'Manage Users',
			'user-roles-manage' => 'Manage Roles & Permissions',
			'restrictions-manage-all' => 'Manage All Entity Permissions',
			'restrictions-manage-own' => 'Manage Entity Permissions On Own Content'
		];
		foreach ($permissionsToCreate as $name => $displayName) {
			$permissionId = DB::table('role_permissions')->insertGetId([
				'name' => $name,
				'display_name' => $displayName,
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
			]);
			DB::table('permission_role')->insert([
				'role_id' => $adminRoleId,
				'permission_id' => $permissionId
			]);
		}

		// Create & attach new entity permissions
		$entities = ['Expense', 'Rabbit', 'Log'];
		$ops = ['Create All', 'Create Own', 'Update All', 'Update Own', 'Delete All', 'Delete Own', 'View All', 'View Own'];
		foreach ($entities as $entity) {
			foreach ($ops as $op) {
				$permissionId = DB::table('role_permissions')->insertGetId([
					'name' => strtolower($entity) . '-' . strtolower(str_replace(' ', '-', $op)),
					'display_name' => $op . ' ' . $entity . 's',
					'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
					'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
				]);
				DB::table('permission_role')->insert([
					'role_id' => $adminRoleId,
					'permission_id' => $permissionId
				]);
			}
		}

		$currentRoles = DB::table('roles')->get();

		// Create admin permissions
		$entities = ['Settings', 'User'];
		$ops = ['Create', 'Update', 'Delete'];
		foreach ($entities as $entity) {
			foreach ($ops as $op) {
				$newPermId = DB::table('role_permissions')->insertGetId([
					'name' => strtolower($entity) . '-' . strtolower($op),
					'display_name' => $op . ' ' . $entity,
					'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
					'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
				]);
				DB::table('permission_role')->insert([
					'permission_id' => $newPermId,
					'role_id' => $admin
				]);
			}
		}

		// Set all current users as admins
		// (At this point only the initially create user should be an admin)

		DB::table('role_user')->insert([
			'role_id' => $admin,
			'user_id' => $user->id
		]);

		User::factory(5)->create();

		Farm::factory(15)->create();

		Rabbit::factory(40)->create([
			'farm_id' => 1,
		]);
		BreedingLog::factory(50)->create([
			'farm_id' => 1,
		]);
	}
}
