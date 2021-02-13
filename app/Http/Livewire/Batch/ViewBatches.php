<?php

namespace App\Http\Livewire\Batch;

use App\Models\Batch;
use Livewire\Component;

class ViewBatches extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.batch.view-batches', [
            'batches' => Batch::all(),
        ])->extends('layouts.app');
    }
}
