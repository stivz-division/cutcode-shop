<?php

namespace Tests\Feature\App\Http\Controllers\Auth;


use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForgotControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_forgot_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.forgot-password');
    }
}
