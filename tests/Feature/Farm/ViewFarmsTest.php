<?php

namespace Tests\Feature\Farm;

use App\Http\Livewire\Farm\ViewFarms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ViewFarmsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function listFarmsPageContainsLivewireComponent()
    {
        $this->get(route('farms.index'))
            ->assertSuccessful()
            ->assertSeeLivewire('farm.view-farms');

        Livewire::test(ViewFarms::class)
        ->assertSuccessful();
    }
}
