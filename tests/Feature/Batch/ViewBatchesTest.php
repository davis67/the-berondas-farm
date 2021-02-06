<?php

namespace Tests\Feature\Batch;

use Tests\TestCase;
use App\Models\User;
use App\Models\Batch;
use Livewire\Livewire;
use App\Http\Livewire\Batch\ViewBatches;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBatchesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function listBatchesPageContainsLivewireComponent()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        Batch::factory(5)->create();

        $batches = Batch::all();

        $this->get(route('batches.index'))
            ->assertSuccessful()
            ->assertSeeLivewire('batch.view-batches');

        Livewire::test(ViewBatches::class)
        ->assertSuccessful();

        $this->assertEquals(5, $batches->count());
    }
}
