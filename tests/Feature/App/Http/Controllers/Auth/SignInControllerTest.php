<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SignInFormRequest;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_login_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))
            ->assertOk()
            ->assertSee('Вход в аккаунт')
            ->assertViewIs('auth.login');

    }

    public function test_it_logout_success(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'testing@cutcode.ru',
            'password' => Hash::make('123443543')
        ]);

        $this
            ->actingAs($user)
            ->delete(action([SignInController::class, 'logout']));

        $this->assertGuest();
    }

    public function test_it_sign_in_success(): void
    {
        $password = '123456789';
        $user = UserFactory::new()->create([
            'email' => 'testing@cutcode.ru',
            'password' => Hash::make($password)
        ]);

        $request = SignInFormRequest::factory()->create([
            'email' => $user->email,
            'password' => $password
        ]);

        $response = $this->post(action([SignInController::class, 'handle']), $request);

        $response->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }
}
