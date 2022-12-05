<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class socialController extends Controller
{
    public function provider($provider)
    {
        if (!$this->validateProvider($provider)) {
            return response()->json(['error' => 'Invalid Provider'], 400);
        }
        //return Socialite::driver($provider)->stateless()->redirect();
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function providerCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $providerUser->email,
            ], [
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                $provider . '_id' => $providerUser->id,
                'provider' => $provider,
                'provider_token' => $providerUser->token,
                'provider_refresh_token' => $providerUser->refreshToken,
                'avatar' => $providerUser->avatar,
                'email_verified_at' => now(),
            ]);

            Auth::login($user);

            /** @var \App\Models\User */

            $currentUser = Auth::user();
            $result = [
                'token_type' => 'Bearer',
                //'token' => auth('api')->login($user),
                'token' => $currentUser->createToken($currentUser->email)->plainTextToken,
                'user' => $currentUser
            ];

            return response()->json($result, 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // social auth provider validation method for google,linkedin and facebook
    public function validateProvider($provider)
    {
        $provider = strtolower($provider);
        $providers = ['google', 'linkedin', 'facebook'];

        if (in_array($provider, $providers)) {
            return true;
        }

        return false;
    }
}
