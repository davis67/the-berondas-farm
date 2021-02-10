<?php

namespace App\Http\Livewire\Batch;

use App\Models\Batch;
use Livewire\Component;

class AddBatch extends Component
{
    public $batch_no;

    public $date_of_construction;

    public $cost_of_construction;

    public $number_of_cages;

    public $expected_number_of_rabbits;

    public function addBatch()
    {
        $this->validate([
            'date_of_construction' => ['required'],
            'cost_of_construction' => ['required'],
            'number_of_cages' => ['required'],
            'expected_number_of_rabbits' => ['required'],
        ]);

        Batch::create([
            'date_of_construction' => $this->date_of_construction,
            'cost_of_construction' => $this->cost_of_construction,
            'number_of_cages' => $this->number_of_cages,
            'expected_number_of_rabbits' => $this->expected_number_of_rabbits,
        ]);

        return redirect(route('batches.index'));
    }

    public function render()
    {
        return view('livewire.batch.add-batch')->extends('layouts.app');
    }
}
