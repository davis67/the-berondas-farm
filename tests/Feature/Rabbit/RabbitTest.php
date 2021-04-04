<?php

namespace Tests\Feature\Rabbit;

use Tests\TestCase;
use App\Models\Cage;
use App\Models\User;
use App\Models\Batch;
use App\Models\Rabbit;
use Livewire\Livewire;
use Illuminate\Support\Arr;
use App\Http\Livewire\Rabbit\ViewRabbits;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RabbitsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function viewRabbitPageContainsLivewireComponent()
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('rabbits.index'))->assertSuccessful();

        Livewire::test(ViewRabbits::class)->assertSuccessful();
    }

    /** @test */
    public function tableSearchesRabbitsNoCorrectly()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number1']);
        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'another']);

        Livewire::test(ViewRabbits::class)
                ->set('filters.search', 'number1')
                ->assertSee($rabbitA->rabbit_no)
                ->assertDontSee($rabbitB->rabbit_no);
    }

    /** @test */
    public function tableSearchesGenderCorrectly()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);
        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'buck']);

        Livewire::test(ViewRabbits::class)
                ->set('filters.gender', 'doe')
                ->assertSee($rabbitA->name)
                ->assertSee($rabbitB->name);
    }

    /** @test */
    public function tableSearchesRabbitsByCageCorrectly()
    {
        $this->actingAs($user = User::factory()->create());

        $batch = Batch::factory()->create(['farm_id' => $user->farm_id]);

        $cage1 = Cage::all()->random(1)->first();
        $cage2 = Cage::all()->random(1)->first();

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage1->id]);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage1->id]);
        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage2->id]);

        Livewire::test(ViewRabbits::class)
                ->set('filters.cage_id', $cage1->id)
                ->assertSee($rabbitA->name)
                ->assertSee($rabbitB->name);
    }

    /** @test */
    public function tableSearchesRabbitsByStatusCorrectly()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'status' => 'alive']);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'status' => 'alive']);

        Livewire::test(ViewRabbits::class)
                ->set('filter.status', 'alive')
                ->assertSee($rabbitA->name)
                ->assertSee($rabbitC->name);
    }

    /** @test */
    public function tableSortsRabbitsByRabbitNoCorrectlyInAscendingOrder()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number1', 'status' => 'alive']);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number2', 'status' => 'alive']);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number3', 'status' => 'alive']);

        Livewire::test(ViewRabbits::class)
                ->call('sortBy', 'rabbit_no')
                ->assertSeeInOrder(['number1', 'number2', 'number3']);
    }

    /** @test */
    public function tableSortsRabbitsByRabbitNoCorrectlyInDescendingOrder()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number1', 'status' => 'alive']);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number2', 'status' => 'alive']);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number3', 'status' => 'alive']);

        Livewire::test(ViewRabbits::class)
                ->call('sortBy', 'rabbit_no')
                ->call('sortBy', 'rabbit_no')
                ->assertSeeInOrder(['number3', 'number2', 'number1']);
    }

    /** @test */
    public function tableSortsRabbitsByCageCorrectlyInAscendingOrder()
    {
        $this->actingAs($user = User::factory()->create());

        $batch = Batch::factory()->create(['farm_id' => $user->farm_id]);

        $cage1 = Cage::all()->random(1)->first();
        $cage2 = Cage::all()->random(1)->first();

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage1->id]);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage1->id]);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'cage_id' => $cage2->id]);

        Livewire::test(ViewRabbits::class)
                ->call('sortBy', 'rabbit_no')
                ->assertSeeInOrder(Arr::sort([$rabbitA->cage_id, $rabbitB->cage_id, $rabbitC->cage_id]));
    }

    /** @test */
    // public function tableSortsRabbitsByCageCorrectlyInDescendingOrder()
    // {
    //     $this->actingAs($user = User::factory()->create());

    //     $batch = Batch::factory()->create(['farm_id' => $user->farm_id]);

    //     $cage1 = Cage::all()->random(1)->first();
    //     $cage1->update(['cage_no' => 'A1']);
    //     $cage2 = Cage::all()->random(1)->first();
    //     $cage2->update(['cage_no' => 'A2']);
    //     $cage3 = Cage::all()->random(1)->first();
    //     $cage3->update(['cage_no' => 'A3']);

    //     $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number1', 'cage_id' => $cage1->id]);

    //     $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number2', 'cage_id' => $cage1->id]);

    //     $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'rabbit_no' => 'number3', 'cage_id' => $cage2->id]);

    //     Livewire::test(ViewRabbits::class)
    //             ->call('sortBy', 'cage_id')
    //             ->assertSeeInOrder(['A3', 'A2', 'A1']);
    // }

    /** @test */
    public function tableSortsRabbitsByGenderCorrectlyInAscendingOrder()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'buck']);

        Livewire::test(ViewRabbits::class)
                ->call('sortBy', 'gender')
                ->assertSeeInOrder(['buck', 'doe', 'doe']);
    }

    /** @test */
    public function tableSortsRabbitsByGenderCorrectlyInDescendingOrder()
    {
        $this->actingAs($user = User::factory()->create());

        $rabbitA = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);

        $rabbitB = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'doe']);

        $rabbitC = Rabbit::factory()->create(['farm_id' => $user->farm_id, 'gender' => 'buck']);

        Livewire::test(ViewRabbits::class)
                ->call('sortBy', 'rabbit_no')
                ->assertSeeInOrder(['doe', 'doe', 'buck']);
    }
}
