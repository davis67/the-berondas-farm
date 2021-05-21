<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Rabbit;
use App\Models\BreedingLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreedingLogFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = BreedingLog::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$date_0f_mating = now()->addDays(-(mt_rand(10, 200)));
		$successful_mating = array_rand([true, false]);
		return [
			'sire_id' => Rabbit::where('gender', 'sire')->inRandomOrder()->first()->id,
			'dam_id' => Rabbit::where('gender', 'dam')->inRandomOrder()->first()->id,
			'date_of_mating' => $date_0f_mating,
			'is_successful_mating' => $successful_mating,
			'kiddle_date' => $successful_mating ? Carbon::parse($date_0f_mating)->addMonths(1)->addDays(mt_rand(0, 2)) : null,
			'litters' => $successful_mating ? mt_rand(3, 10) : null,
			'dead_litters' => $successful_mating ? 0 : null,
			'doe_litters' => $successful_mating ? 0 : null
		];
	}
}
