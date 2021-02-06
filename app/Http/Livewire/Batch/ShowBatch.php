<?php

namespace App\Http\Livewire\Batch;

use App\Models\Batch;
use Livewire\Component;

class ShowBatch extends Component
{
    /**
     * @var
     */
    public $batch;

    public function mount(Batch $batch)
    {
        $this->batch = $batch->loadMissing('cages');
    }

    public function render()
    {
        return view('livewire.batch.show-batch')->extends('layouts.app');
    }
}
