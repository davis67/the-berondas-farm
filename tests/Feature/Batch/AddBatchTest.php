<?php

namespace Tests\Feature\Batch;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Batch\AddBatch;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddBatchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function addBatchPageContainsLivewireComponent()
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('batches.create'))
            ->assertSuccessful()
            ->assertSeeLivewire('batch.add-batch');

        Livewire::test(AddBatch::class)->assertSuccessful();
    }
}
