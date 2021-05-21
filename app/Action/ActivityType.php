<?php

namespace App\Action;

class ActivityType
{
	const USER_CREATE = 'user_create';
	const USER_UPDATE = 'user_update';
	const USER_DELETE = 'user_delete';

	const API_TOKEN_CREATE = 'api_token_create';
	const API_TOKEN_UPDATE = 'api_token_update';
	const API_TOKEN_DELETE = 'api_token_delete';

	const AUTH_PASSWORD_RESET = 'auth_password_reset_request';
	const AUTH_PASSWORD_RESET_UPDATE = 'auth_password_reset_update';

	const AUTH_LOGIN = 'auth_login';
	const AUTH_REGISTER = 'auth_register';
}
