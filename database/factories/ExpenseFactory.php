<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expense_date' => now(),
            'expense_type_id' => mt_rand(1, 5),
            'amount' => array_rand([100000, 75000, 50000, 200000]),
            'farm_id' => 1,
        ];
    }
}
