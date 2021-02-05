<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                   'name' => 'The Berondas Farm',
                   'contacts' => '0700000001',
                   'address' => 'B26 LABZ',
               ]);

        User::create([
                   'name' => 'User Example',
                   'email' => 'admin@example.com',
                   'email_verified_at' => now(),
                   'password' => bcrypt('password'),
                   'farm_id' => $farm->id,
                   'remember_token' => Str::random(10),
               ]);
        User::factory(5)->create();
        Farm::factory(15)->create();
    }
}
