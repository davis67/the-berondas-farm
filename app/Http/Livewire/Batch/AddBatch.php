<?php

namespace App\Http\Livewire\Batch;

use App\Models\Batch;
use Livewire\Component;

class AddBatch extends Component
{
    /**
     * The Batch Number.
     *
     * @var string
     */
    public $batch_no;

    /**
     * Date of Construction.
     *
     * @var date
     */
    public $date_of_construction;

    /**
     * Cost of the Construction.
     *
     * @var int
     */
    public $cost_of_construction;

    /**
     * Number of Cages.
     *
     * @var int
     */
    public $number_of_cages;

    /**
     * Handler the resource that adds a batch to the farm.
     *
     * @return void
     */
    public function addBatch()
    {
        $this->validate([
            'date_of_construction' => ['required'],
            'cost_of_construction' => ['required'],
            'number_of_cages' => ['required'],
        ]);

        Batch::create([
            'date_of_construction' => $this->date_of_construction,
            'cost_of_construction' => $this->cost_of_construction,
            'number_of_cages' => $this->number_of_cages,
        ]);

        return redirect(route('batches.index'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.batch.add-batch')->extends('layouts.app');
    }
}
