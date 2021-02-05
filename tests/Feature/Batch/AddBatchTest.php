<?php

namespace Tests\Feature\Batch;

use App\Http\Livewire\Batch\AddBatch;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

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
