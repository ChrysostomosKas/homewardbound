<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravolt\Avatar\Avatar;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            if (User::where('email', $socialUser->getEmail())->exists()) {
                return redirect('/login')->withErrors(['email' => 'This email uses different method to login.']);
            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $socialUser->id
            ])->first();

            if (!$user) {
                $avatar = new Avatar();
                list($firstName, $lastName) = explode(' ', $socialUser->nickname);
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'username' => $socialUser->nickname,
                    'email' => $socialUser->email,
                    'provider_token' => $socialUser->token,
                    'avatar' => $avatar->create($socialUser->nickname)->toBase64(),
                    'provider_id' => $socialUser->id,
                    'provider' => $provider
                ]);
            }

            Auth::login($user);
            return redirect('/');
        } catch (\Exception $exception) {
            return redirect('/login');
        }
    }
}
