<?php

namespace Tests\Feature\Rabbit;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Rabbit\AddRabbit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddRabbitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function addRabbitPageContainsLivewireComponent()
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('rabbits.create'))
            ->assertSuccessful()
            ->assertSeeLivewire('rabbit.add-rabbit');

        Livewire::test(AddRabbit::class)->assertSuccessful();
    }
}
