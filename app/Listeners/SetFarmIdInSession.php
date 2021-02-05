<?php

namespace App\Listeners;

class SetFarmIdInSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        session()->put('farm_id', $event->user->farm_id);
    }
}
