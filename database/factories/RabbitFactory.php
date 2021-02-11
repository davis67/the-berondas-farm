<?php

namespace Database\Factories;

use App\Models\Rabbit;
use Illuminate\Database\Eloquent\Factories\Factory;

class RabbitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rabbit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'breed' => $this->faker->name,
            'gender' => 'female',
            'status' => 'alive',
            'date_of_birth' => now()->addDays(-(mt_rand(10, 100))),
        ];
    }
}
