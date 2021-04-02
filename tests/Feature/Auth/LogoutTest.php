<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anAuthenticatedUserCanLogOut()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->post(route('logout'));
        $response->assertRedirect(route('home'));

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function anUnauthenticatedUserCanNotLogOut()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertFalse(Auth::check());
    }
}
