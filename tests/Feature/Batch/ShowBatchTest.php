<?php

namespace Tests\Feature\Batch;

use Tests\TestCase;
use App\Models\User;
use App\Models\Batch;
use Livewire\Livewire;
use App\Http\Livewire\Batch\ShowBatch;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowBatchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showBatchesPageContainsLivewireComponent()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $batch = Batch::factory()->create();

        $this->get(route('batches.show', $batch->id))
            ->assertSuccessful()
            ->assertSeeLivewire('batch.show-batch');

        Livewire::test(ShowBatch::class)
        ->assertSuccessful();
    }
}
