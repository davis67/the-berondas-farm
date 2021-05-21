<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Action\ActivityType;
use App\Action\ActivityService;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\LoggableActivity;

class Login extends Component
{
	use LoggableActivity;

	/** @var string */
	public $email = '';

	/** @var string */
	public $password = '';

	/** @var bool */
	public $remember = false;

	/*** @var ActivityService $activityService */
	protected $activity = null;

	protected $rules = [
		'email' => ['required', 'email'],
		'password' => ['required'],
	];

	/**
	 * Component mount.
	 * @param ActivityService $activityService
	 */
	public function mount(ActivityService $activityService)
	{
		$this->activity = $activityService;
	}

	public function authenticate()
	{
		$this->validate();

		if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
			$this->addError('email', trans('auth.failed'));
			app(ActivityService::class)->logFailedLogin($this->email);
			return;
		}
		$user = auth()->user();

		$this->logActivity(ActivityType::AUTH_LOGIN, $user);

		return redirect()->intended(route('home'));
	}

	public function render()
	{
		return view('livewire.auth.login')->extends('layouts.auth');
	}
}
