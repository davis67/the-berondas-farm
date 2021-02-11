<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_of_construction' => now()->addDays(-4),
            'cost_of_construction' => 56000,
            'number_of_cages' => 10,
            'expected_number_of_rabbits' => 50,
        ];
    }
}
