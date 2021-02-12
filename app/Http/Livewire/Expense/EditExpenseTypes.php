<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\ExpenseType;
use Illuminate\Validation\Rule;

class EditExpenseTypes extends Component
{
    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Instance of Breed Type.
     *
     * @var string
     */
    public $expenseType;

    /**
     * Description.
     *
     * @var string
     */
    public $description;

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
    public function mount(ExpenseType $expenseType)
    {
        $this->expenseType = $expenseType;
        $this->name = $expenseType->name;
        $this->description = $expenseType->description;
    }

    /**
     * Add the Expense Types.
     *
     * @return void
     */
    public function updateExpenseTypes()
    {
        $data = $this->validate([
            'name' => ['required', Rule::unique('expense_types')->ignore($this->expenseType->id)],
            'description' => 'nullable',
        ]);

        $this->confirmingExpenseDeletion = true;

        $this->expenseType->update([
            'name' => mb_strtolower($this->name),
            'description' => mb_strtolower($this->description),
        ]);

        session()->flash('success', 'You have successfully updated an expenseType.');

        return redirect(route('breed-types.index'));
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
        $this->expenseType->delete();

        $this->confirmingExpenseDeletion = false;

        session()->flash('success', 'You have successfully deleted a expenseType.');

        return redirect(route('expense-types.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.expense.edit-expense-types');
    }
}
