<?php

namespace Tests\Feature\Farm;

use App\Http\Livewire\Farm\EditFarm;
use App\Models\Farm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditFarmTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function farmEditPageContainsLivewireComponent()
    {
        $farm = Farm::factory()->create();

        $this->get(route('farms.edit', $farm->id))
            ->assertSuccessful()
            ->assertSeeLivewire('farm.edit-farm');

        Livewire::test(EditFarm::class)
        ->assertSuccessful();
    }
}
