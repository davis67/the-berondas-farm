<?php

namespace Tests\Feature\Farm;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Farm\RegisterFarm;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterFarmTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function farm_creation_page_contains_livewire_component()
    {
        Livewire::test(RegisterFarm::class)
        ->assertSuccessful();
    }
}
