<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $driver)
    {
        try {
            return Socialite::driver($driver)
                ->redirect();
        } catch (\Throwable $exception) {
            throw new \DomainException(__('Произошла ошибка или драйвер не поддерживается'));
        }
    }

    public function callback(string $driver): RedirectResponse
    {
        if ($driver !== 'github') {
            throw new \DomainException(__('Драйвер не поддерживается'));
        }

        $githubUser = Socialite::driver($driver)->user();

        $user = User::query()->updateOrCreate([
            $driver . '_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name ?? 'New User',
            'email' => $githubUser->email,
            'password' => Hash::make(str()->random(20))
        ]);

        auth()->login($user);

        return redirect()
            ->intended(route('home'));
    }
}
