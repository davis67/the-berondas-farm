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
            'rabbit_no' => $this->faker->name,
            'gender' => collect(Rabbit::GENDER)->keys()->random(),
            'status' => collect(Rabbit::STATUS)->keys()->random(),
            'date_of_birth' => now()->addDays(-(mt_rand(10, 100))),
        ];
    }
}
