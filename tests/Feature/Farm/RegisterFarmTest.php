<?php

namespace Tests\Feature\Farm;

use App\Http\Livewire\Farm\RegisterFarm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterFarmTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function farmCreationPageContainsLivewireComponent()
    {
        Livewire::test(RegisterFarm::class)
        ->set('name', 'The Berondas Farm')
        ->set('contacts', '0704123412/0702933943')
        ->set('address', 'Rodar Lane-Kisaasi')
        ->call('registerFarm')
        ->assertSuccessful();
    }
}
