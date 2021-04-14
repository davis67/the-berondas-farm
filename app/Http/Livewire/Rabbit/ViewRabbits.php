<?php

namespace App\Http\Livewire\Rabbit;

use Carbon\Carbon;
use App\Models\Cage;
use App\Models\Rabbit;
use Livewire\Component;
use App\Models\BreedType;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithBulkAction;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class ViewRabbits extends Component
{
	use WithPerPagePagination;
	use WithBulkAction;
	use WithSorting;
	/**
	 * Instance.
	 *
	 * @var object
	 */
	public Rabbit $rabbit;

	/**
	 * Show Save Modal.
	 *
	 * @var string
	 */
	public $showSaveModal = false;

	/**
	 * Show Details page.
	 *
	 * @var string
	 */
	public $showDetailsScreen = false;

	/**
	 * The Filters.
	 *
	 * @var bool
	 */
	public $showFilters = false;

	/**
	 * The selected rabbit instance.
	 *
	 * @var mixed
	 */
	public $selectedRabbit = null;

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
	 * Registers a blank rabbit.
	 *
	 * @return <type> ( description_of_the_return_value )
	 */
	public function registersBlankRabbit()
	{
		return Rabbit::make([]);
	}

	/**
	 * Select rabbit for details display .
	 *
	 * @return <type> ( description_of_the_return_value )
	 */
	public function selectRabbit($id)
	{
		$this->showDetailsScreen = true;
		$this->selectedRabbit = Rabbit::findOrFail($id);
	}

	/**
	 * Close the display dialog for showing rabbit details
	 *
	 * @return <type> ( description_of_the_return_value )
	 */
	public function deselectRabbit()
	{
		return $this->showDetailsScreen = !$this->showDetailsScreen;
		// $this->selectedRabbit = null;
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
		return response()->streamDownload(
			function () {
				echo $this->selectedRowsQuery->toCsv();
			},
			'rabbits.csv'
		);

		$this->notify('Data Exported successfully');
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
		$this->notify('Data Deleted successfully');
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

		$this->notify('Rabbit Info successfully Saved.');
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

		$this->confirmingRabbitDeletion = false;

		$this->notify('Rabbit Info successfully deleted.');

		// return redirect(route('rabbits.index'));
	}

	public function create()
	{
		$this->showSaveModal = true;
		$this->rabbit = $this->registersBlankRabbit();
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
	 * Render the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view(
			'livewire.rabbit.view-rabbits',
			[
				'rabbits_count' => Rabbit::alive()->count(),
				'all_rabbits_count' => Rabbit::count(),
				'bucks' => Rabbit::ofGender('buck')->alive()->count(),
				'dam' => Rabbit::ofGender('dam')->alive()->count(),
				'sire' => Rabbit::ofGender('sire')->alive()->count(),
				'does' => Rabbit::ofGender('doe')->alive()->count(),
				'kits' => Rabbit::ofGender('unknown')->alive()->count(),
				'rabbits' => $this->rows,
				'cages' => Cage::all(),
				'rabbitTypes' => BreedType::all(),
			]
		)->extends('layouts.app');
	}
}
