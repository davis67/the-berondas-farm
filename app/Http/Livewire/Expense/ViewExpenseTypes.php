<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\ExpenseType;

class ViewExpenseTypes extends Component
{
    public function render()
    {
        return view('livewire.expense.view-expense-types', [
            'expense_types' => ExpenseType::all(),
        ]);
    }
}
