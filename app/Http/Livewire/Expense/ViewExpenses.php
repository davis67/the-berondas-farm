<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ViewExpenses extends Component
{
    use WithPagination;

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
     * The Filters.
     *
     * @var array
     */
    public $filters = [
        'search' => '',
        'date-min' => null,
        'date-max' => null,
    ];

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
        $this->reset('filters');
    }

    /**
     * Update the reset filters.
     *
     * @var void
     */
    public function updatedFIlters()
    {
        $this->resetPage();
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
                ->when($this->filters['date-min'], fn ($query, $date) => $query->where('created_at', '>=', Carbon::parse($date)))
                ->when($this->filters['date-max'], fn ($query, $date) => $query->where('created_at', '<=', Carbon::parse($date)))
                ->search('amount', $this->filters['search'])
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
            'all_expenses' => Expense::count(),
        ])->extends('layouts.app');
    }
}
