<?php

namespace Database\Seeders;

use App\Models\BreedingLog;
use App\Models\Farm;
use App\Models\User;
use App\Models\Rabbit;
use App\Models\ExpenseType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

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

		User::create([
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
