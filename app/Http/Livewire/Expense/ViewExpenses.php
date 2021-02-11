<?php

namespace App\Http\Livewire\Expense;

use Carbon\Carbon;
use App\Models\Expense;
use Livewire\Component;
use App\Models\ExpenseType;
use Livewire\WithPagination;

class ViewExpenses extends Component
{
    use WithPagination;

    /**
     * Search.
     *
     * @var string
     */
    public $search = '';

    /**
     * The Sort.
     *
     * @var string
     */
    public $sortField = 'amount';

    /**
     * The Sort Direction.
     *
     * @var string
     */
    public $sortDirection = 'asc';

    /**
     * The Filters.
     *
     * @var bool
     */
    public $showFilters = false;

    /**
     * The Selected.
     *
     * @var array
     */
    public $selected = [];

    /**
     * Date min.
     *
     * @var array
     */
    public $date_min;

    /**
     * Date max.
     *
     * @var array
     */
    public $date_max;

    /**
     * Query String.
     *
     * @var array
     */
    protected $queryString = ['sortField', 'sortDirection'];

    /**
     * Sort the expenses by the fields.
     *
     * @var void
     */
    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = 'asc' == $this->sortDirection ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    /**
     * Reset Filters.
     *
     * @var void
     */
    public function resetFilters()
    {
        $this->reset(['date_max', 'date_min']);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.expense.view-expenses', [
            'expenses' => Expense::query()
                ->with('category')
                ->when($this->search, fn ($query, $value) => $query->where('expense_type_id', $value))
                 ->when($this->date_min, fn ($query, $date) => $query->where('created_at', '>=', Carbon::parse($date)))
                ->when($this->date_max, fn ($query, $date) => $query->where('created_at', '<=', Carbon::parse($date)))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
            'expense_types' => ExpenseType::all(),
        ])->extends('layouts.app');
    }
}
