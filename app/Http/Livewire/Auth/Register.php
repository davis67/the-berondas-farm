<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Action\ActivityType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Livewire\Traits\LoggableActivity;

class Register extends Component
{
	use LoggableActivity;

	/** @var string */
	public $name = '';

	/** @var string */
	public $email = '';

	/** @var string */
	public $password = '';

	/** @var string */
	public $passwordConfirmation = '';

	public function register()
	{
		$this->validate([
			'name' => ['required'],
			'email' => ['required', 'email', 'unique:users'],
			'password' => ['required', 'min:8', 'same:passwordConfirmation'],
		]);

		$user = User::create([
			'email' => $this->email,
			'name' => $this->name,
			'password' => Hash::make($this->password),
			'farm_id' => auth()->user()->farm_id,
		]);

		event(new Registered($user));

		$this->logActivity(ActivityType::USER_CREATE, $user);

		Auth::login($user, true);

		return redirect()->intended(route('home'));
	}

	public function render()
	{
		return view('livewire.auth.register');
	}
}
