<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;
use App\Models\BreedType;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class ViewRabbits extends Component
{
    use WithPerPagePagination;
    /**
     * Select Page .
     *
     * @var int
     */
    public $selectPage;

    /**
     * Instance.
     *
     * @var object
     */
    public Rabbit $rabbit;

    /**
     * Search.
     *
     * @var string
     */
    public $search = '';

    /**
     * Show Save Modal.
     *
     * @var string
     */
    public $showSaveModal = false;

    /**
     * The Sort.
     *
     * @var string
     */
    public $sortField = 'created_at';

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
     * The selected rabbit instance.
     *
     * @var mixed
     */
    public $selectRabbitId;

    /**
     * Status     *.
     *
     * @var string
     */
    public $status;

    /**
     * Check if one is creating.
     *
     * @var string
     */
    public $showRabbitNo = true;

    /**
     * gender.
     *
     * @var string
     */
    public $gender = '';

    /**
     * Date max.
     *
     * @var array
     */
    public $date_max;

    /**
     * Indicates if rabbit transfer is being confirmed.
     *
     * @var bool
     */
    public $confirmingRabbitDeletion = false;

    /**
     * Cage Id.
     *
     * @var array
     */
    public $cage_id;

    /**
     * Query String.
     *
     * @var array
     */
    protected $queryString = ['search', 'sortField', 'sortDirection'];

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

    public function updatingSearch()
    {
        $this->resetPage();
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
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $query = Rabbit::query()
                ->when($this->search, fn ($query, $value) => $query->where('rabbit_no', $value))
                ->when($this->gender, fn ($query, $value) => $query->where('gender', $value))
                ->when($this->status, fn ($query, $value) => $query->where('status', $value))
                ->when($this->cage_id, fn ($query, $value) => $query->where('cage_id', $value))
                ->when($this->date_min, fn ($query, $date) => $query->where('date_of_birth', '>=', Carbon::parse($date)))
                ->when($this->date_max, fn ($query, $date) => $query->where('date_of_birth', '<=', Carbon::parse($date)))
                ->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.rabbit.view-rabbits', [
            'rabbits_count' => Rabbit::count(),
            'bucks' => Rabbit::where('gender', 'buck')->count(),
            'does' => Rabbit::where('gender', 'doe')->count(),
            'kits' => Rabbit::where('gender', 'unknown')->count(),
            'rabbits' => $this->applyPagination($query),
            'cages' => Cage::all(),
            'rabbitTypes' => BreedType::all(),
        ])->extends('layouts.app');
    }
}
