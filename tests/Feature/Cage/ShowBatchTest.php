<?php

namespace Tests\Feature\Batch;

use Tests\TestCase;
use App\Models\Cage;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Cage\ShowCage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showCagePageContainsLivewireComponent()
    {
        $this->actingAs($user = User::factory()->create());

        $cage = Cage::factory()->create();

        $this->get(route('cages.show', $cage->id))
            ->assertSuccessful();

        Livewire::test(ShowCage::class)
        ->assertSuccessful();
    }
}
