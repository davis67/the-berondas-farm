<?php

namespace App\Http\Livewire\DataTable;

trait WithBulkAction
{
    /**
     * Select Page .
     *
     * @var int
     */
    public $selectPage;

    /**
     * The Selected.
     *
     * @var array
     */
    public $selected = [];
    /**
     * Check if all rows are selected.
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * Initializes the with bulk actions.
     *
     * @return void
     */
    public function initializeWithBulkActions()
    {
        if ($this->selectAll) {
            $this->selectAllRows();
        }
        $this->selected = [];
    }

    /**
     * Event that is triggered when the selectPage attribute is updated.
     *
     * @param bool $value The updated value
     *
     * @return <void>
     */
    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selectAllPageRows();

            return $this->selected;
        }
        $this->selectAll = false;
        $this->selected = [];
    }

    /**
     * Checks if all the rows in the table are selected.
     *
     * @return void
     */
    public function selectAll()
    {
        $this->selectAll = true;
        $this->selectAllPageRows();
    }

    /**
     * Select all the rows in the table.
     *
     * @return void
     */
    public function selectAllPageRows()
    {
        $this->selected = $this->rowsQuery->pluck('id')->map(fn ($id) => (string) $id);
    }

    /**
     * Selected Rows.
     *
     * @return Response
     */
    public function getSelectedRowsQueryProperty()
    {
        return (clone $this->rowsQuery)
            ->unless($this->selectAll, fn ($query) => $query->whereKey($this->selected));
    }
}
