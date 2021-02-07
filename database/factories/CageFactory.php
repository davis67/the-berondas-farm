<?php

namespace Database\Factories;

use App\Models\Cage;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class CageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'batch_id' => Batch::factory()->create(),
            'cage_no' => 'CAGE-1234',
        ];
    }
}
