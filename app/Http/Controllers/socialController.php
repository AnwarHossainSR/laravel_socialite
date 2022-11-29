<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class socialController extends Controller
{
    public function provider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback($provider)
    {
        try {
            $providerUser = Socialite::driver('linkedin')->user();

            $user = User::updateOrCreate([
                'provider_id' => $providerUser->id,
            ], [
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                'provider_id' => $providerUser->id,
                'provider' => $provider,
                'provider_token' => $providerUser->token,
                'provider_refresh_token' => $providerUser->refreshToken,
                'avatar' => $providerUser->avatar,
                'email_verified_at' => now(),
            ]);

            Auth::login($user);

            return Auth::user();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
