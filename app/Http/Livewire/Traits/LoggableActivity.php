<?php

namespace App\Http\Livewire\Traits;

use App\Action\ActivityService;

trait LoggableActivity
{
	/**
	 * Log an activity in the system.
	 * @param string|Loggable
	 */
	protected function logActivity(string $type, $detail = ''): void
	{
		app(ActivityService::class)->add($type, $detail);
	}
}
