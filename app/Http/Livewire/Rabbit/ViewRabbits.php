<?php

namespace App\Http\Livewire\Rabbit;

use Carbon\Carbon;
use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;
use App\Models\BreedType;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class ViewRabbits extends Component
{
    use WithPerPagePagination;
    use WithSorting;
    /**
     * Instance.
     *
     * @var object
     */
    public Rabbit $rabbit;

    /**
     * Select Page .
     *
     * @var int
     */
    public $selectPage;

    /**
     * Show Save Modal.
     *
     * @var string
     */
    public $showSaveModal = false;

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
     * Check if all rows are selected.
     *
     * @var array
     */
    public $selectAll = false;

    /**
     * The selected rabbit instance.
     *
     * @var mixed
     */
    public $selectRabbitId;

    /**
     * Check if one is creating.
     *
     * @var string
     */
    public $showRabbitNo = true;

    /**
     * Indicates if rabbit transfer is being confirmed.
     *
     * @var bool
     */
    public $confirmingRabbitDeletion = false;

    /**
     * Show Delete Modal.
     *
     * @var bool
     */
    public $showDeleteModal = false;

    /**
     * Filters.
     *
     * @var array
     */
    public $filters = [
        'search' => '',
        'status' => '',
        'gender' => '',
        'cage_id' => '',
        'date_max' => null,
        'date_min' => null,
    ];

    /**
     * Validate the rabbits attributes.
     *
     * @var array
     */
    public function rules()
    {
        return [
            'rabbit.rabbit_no' => 'nullable',
            'rabbit.cage_id' => 'required',
            'rabbit.breed_id' => 'nullable',
            'rabbit.gender' => 'required|in:' . collect(Rabbit::GENDER)->keys()->implode(','),
            'rabbit.date_of_birth' => 'nullable',
        ];
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->rows->pluck('id')->map(fn ($id) => (string) $id);

            return $this->selected;
        }
        $this->selected = [];
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->selected = $this->rowsQuery->pluck('id')->map(fn ($id) => (string) $id);
    }

    public function makeBlankTransaction()
    {
        return Rabbit::make([]);
    }

    /**
     * Validate the transfer of the rabbit from one cage to another.
     *
     * @return void
     */
    public function validateDeletion($id)
    {
        $this->selectRabbitId = $id;

        $this->confirmingRabbitDeletion = true;
    }

    /**
     * Generate export from the selected rows.
     *
     * @return Response
     */
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'rabbits.csv');
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

    /**
     * Delete all the selected rows.
     *
     * @return Response
     */
    public function deleteSelected()
    {
        $this->selectedRowsQuery
        ->delete();
        $this->showDeleteModal = false;
    }

    /**
     * Save the rabbit information.
     *
     * @return void
     */
    public function handleSave(Rabbit $rabbit)
    {
        $this->showSaveModal = true;
        $this->rabbit = $rabbit;
        $this->showRabbitNo = true;
    }

    /**
     * Save the rabbit information.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->rabbit->save();
        $this->showSaveModal = false;
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
     * Handle the deletion of the rabbit.
     *
     * @return void
     */
    public function handleDeletion()
    {
        $selectedRabbit = Rabbit::findOrFail($this->selectRabbitId);

        $selectedRabbit->delete();

        $this->confirmingRabbitTransfer = false;

        session()->flash('success', 'Rabbit Info successfully deleted.');

        return redirect(route('rabbits.index'));
    }

    public function create()
    {
        $this->showSaveModal = true;
        $this->rabbit = $this->makeBlankTransaction();
        $this->showRabbitNo = false;
    }

    /**
     * Row Query.
     *
     * @return
     */
    public function getRowsQueryProperty()
    {
        $query = Rabbit::query()
                ->when($this->filters['search'], fn ($query, $search) => $query->where('rabbit_no', 'like', '%' . $search . '%'))
                ->when($this->filters['gender'], fn ($query, $gender) => $query->where('gender', $gender))
                ->when($this->filters['status'], fn ($query, $value) => $query->where('status', $value))
                ->when($this->filters['cage_id'], fn ($query, $value) => $query->where('cage_id', $value))
                ->when($this->filters['date_min'], fn ($query, $date) => $query->where('date_of_birth', '>=', Carbon::parse($date)))
                ->when($this->filters['date_max'], fn ($query, $date) => $query->where('date_of_birth', '<=', Carbon::parse($date)));

        return $this->applySorting($query);
    }

    /**
     * Row.
     *
     * @return
     */
    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    /**
     * Querying Rabbits that are alive.
     *
     * @return
     */
    public function getLiveRabbitsProperty()
    {
        return Rabbit::alive();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.rabbit.view-rabbits', [
            'rabbits_count' => $this->liveRabbits->count(),
            'bucks' => $this->liveRabbits->where('gender', 'buck')->count(),
            'does' => $this->liveRabbits->where('gender', 'doe')->count(),
            'kits' => $this->liveRabbits->where('gender', 'unknown')->count(),
            'rabbits' => $this->rows,
            'cages' => Cage::all(),
            'rabbitTypes' => BreedType::all(),
        ])->extends('layouts.app');
    }
}
