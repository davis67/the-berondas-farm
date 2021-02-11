<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use App\Models\ExpenseType;

class RegisterExpenses extends Component
{
    /**
     * Amount.
     *
     * @var int
     */
    public $amount;

    /**
     * Date of Expense.
     *
     * @var date
     */
    public $expense_date;

    /**
     * Expense Type.
     *
     * @var int
     */
    public $expense_type_id;

    /**
     * Storing the Farm resource.
     *
     * @return void
     */
    public function registerExpenses()
    {
        $this->validate([
            'expense_date' => ['required'],
            'expense_type_id' => ['required'],
            'amount' => ['required'],
        ]);

        Expense::create([
            'expense_date' => $this->expense_date,
            'expense_type_id' => $this->expense_type_id,
            'amount' => $this->amount,
            'farm_id' => auth()->user()->farm_id,
        ]);

        return redirect(route('expenses.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.expense.register-expenses', [
            'expense_types' => ExpenseType::all(),
        ])->extends('layouts.app');
    }
}
