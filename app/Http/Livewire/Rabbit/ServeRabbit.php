<?php

namespace App\Http\Livewire\Rabbit;

use App\Models\Rabbit;
use Livewire\Component;
use App\Models\Servicing;

class ServeRabbit extends Component
{
    /**
     * The Rabbit instance.
     *
     * @var mixed
     */
    public $rabbit;

    /**
     * Date of Serving.
     *
     * @var Date
     */
    public $date_of_serving;

    /**
     * Male Rabbit Instance.
     *
     * @var string
     */
    public $male_rabbit;

    /**
     * Female Rabbit Instance.
     *
     * @var string
     */
    public $female_rabbit;

    /**
     * Mount the component.
     *
     * @param mixed $cage
     *
     * @return void
     */
    public function mount($id)
    {
        $this->rabbit = Rabbit::findOrFail($id);
    }

    /**
     * Updating the Rabbit resource.
     *
     * @return void
     */
    public function handleRabbitServing()
    {
        $this->validate([
            'male_rabbit' => ['required'],
            'female_rabbit' => ['required'],
            'date_of_serving' => ['required'],
        ]);

        Servicing::create([
            'father_id' => $this->male_rabbit,
            'mother_id' => $this->female_rabbit,
            'date_of_servicing' => $this->date_of_serving,
        ]);

        session()->flash('success', 'We have served the rabbit in the farm.');

        return redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.rabbit.serve-rabbit', [
            'male_rabbits' => Rabbit::where('gender', 'buck')->get(),
            'female_rabbits' => Rabbit::where('gender', 'doe')->get(),
        ]);
    }
}
