<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use App\Models\ExpenseType;

class EditExpenses extends Component
{
    /**
     * Instace of the expense.
     *
     * @var int
     */
    public $expense;
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
     * Indicates if breed deletion is being confirmed.
     *
     * @var bool [<description>]
     */
    public $confirmingExpenseDeletion = false;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount(Expense $expense)
    {
        $this->expense = $expense;
        $this->expense_date = $expense->expense_date;
        $this->amount = $expense->amount;
        $this->expense_type_id = $expense->expense_type_id;
    }

    /**
     * Storing the Farm resource.
     *
     * @return void
     */
    public function updateExpense()
    {
        $this->validate([
            'expense_date' => ['required'],
            'expense_type_id' => ['required'],
            'amount' => ['required'],
        ]);

        $this->expense->update([
            'expense_date' => $this->expense_date,
            'expense_type_id' => $this->expense_type_id,
            'amount' => $this->amount,
        ]);

        return redirect(route('expenses.index'));
    }

    /**
     * Confirm the deletion of the Expense breed.
     *
     * @return void
     */
    public function confirmingDeletion()
    {
        $this->confirmingExpenseDeletion = true;
    }

    /**
     * Close the confirmation modal of the deletion of the Expense breed.
     *
     * @return void
     */
    public function closeConfirmingDeletion()
    {
        $this->confirmingExpenseDeletion = false;
    }

    /**
     * Confirm the deletion of the Expense breed.
     *
     * @return void
     */
    public function deleteExpense()
    {
        $this->expense->delete();

        $this->confirmingExpenseDeletion = false;

        session()->flash('success', 'You have successfully deleted a Expense.');

        return redirect(route('expenses.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.expense.edit-expenses', [
            'expense_types' => ExpenseType::all(),
        ]);
    }
}
