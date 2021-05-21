<?php

namespace App\Auth\Access;

use Exception;
use App\Auth\User;
use App\Auth\UserRepo;
use App\Exceptions\UserRegistrationException;

class RegistrationService
{
	protected $userRepo;
	protected $emailConfirmationService;

	/**
	 * RegistrationService constructor.
	 */
	public function __construct(UserRepo $userRepo, EmailConfirmationService $emailConfirmationService)
	{
		$this->userRepo = $userRepo;
		$this->emailConfirmationService = $emailConfirmationService;
	}

	/**
	 * Check whether or not registrations are allowed in the app settings.
	 * @throws UserRegistrationException
	 */
	public function ensureRegistrationAllowed()
	{
		if (!$this->registrationAllowed()) {
			throw new UserRegistrationException(trans('auth.registrations_disabled'), '/login');
		}
	}

	/**
	 * Check if standard App User registrations are currently allowed.
	 * Does not prevent external-auth based registration.
	 */
	protected function registrationAllowed(): bool
	{
		$authMethod = config('auth.method');
		$authMethodsWithRegistration = ['standard'];
		return in_array($authMethod, $authMethodsWithRegistration) && setting('registration-enabled');
	}

	/**
	 * The registrations flow for all users.
	 * @throws UserRegistrationException
	 */
	public function registerUser(array $userData, bool $emailConfirmed = false): User
	{
		$userEmail = $userData['email'];

		// Email restriction
		// $this->ensureEmailDomainAllowed($userEmail);
		// Ensure user does not already exist
		$alreadyUser = !is_null($this->userRepo->getByEmail($userEmail));
		if ($alreadyUser) {
			throw new UserRegistrationException(trans('errors.error_user_exists_different_creds', ['email' => $userEmail]), '/login');
		}

		// Create the user
		$newUser = $this->userRepo->registerNew($userData, $emailConfirmed);

		// Start email confirmation flow if required
		if ($this->emailConfirmationService->confirmationRequired() && !$emailConfirmed) {
			$newUser->save();

			try {
				$this->emailConfirmationService->sendConfirmation($newUser);
				session()->flash('sent-email-confirmation', true);
			} catch (Exception $e) {
				$message = trans('auth.email_confirm_send_error');
				throw new UserRegistrationException($message, '/register/confirm');
			}
		}

		return $newUser;
	}

	/**
	 * Ensure that the given email meets any active email domain registration restrictions.
	 * Throws if restrictions are active and the email does not match an allowed domain.
	 * @throws UserRegistrationException
	 */
	protected function ensureEmailDomainAllowed(string $userEmail): void
	{
		$registrationRestrict = setting('registration-restrict');

		if (!$registrationRestrict) {
			return;
		}

		$restrictedEmailDomains = explode(',', str_replace(' ', '', $registrationRestrict));
		$userEmailDomain = $domain = mb_substr(mb_strrchr($userEmail, '@'), 1);
		if (!in_array($userEmailDomain, $restrictedEmailDomains)) {
			$redirect = $this->registrationAllowed() ? '/register' : '/login';
			throw new UserRegistrationException(trans('auth.registration_email_domain_invalid'), $redirect);
		}
	}
}
