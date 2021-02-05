<?php

namespace App\Http\Livewire\Batch;

use Livewire\Component;

class AddBatch extends Component
{
    public function render()
    {
        return view('livewire.batch.add-batch')->extends('layouts.app');
    }
}
