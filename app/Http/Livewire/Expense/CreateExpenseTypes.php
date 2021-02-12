<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\ExpenseType;

class CreateExpenseTypes extends Component
{
    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Description.
     *
     * @var string
     */
    public $description;

    /**
     * Add the Rabbit Types.
     *
     * @return void
     */
    public function addExpenseTypes()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        ExpenseType::create([
            'name' => mb_strtolower($this->name),
            'description' => mb_strtolower($this->description),
            // 'farm_id' => auth()->user()->id,
        ]);

        session()->flash('success', 'You have successfully added an Expense Type.');

        return redirect(route('expense-types.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.expense.create-expense-types');
    }
}
