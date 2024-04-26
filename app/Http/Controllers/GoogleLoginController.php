<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravolt\Avatar\Avatar;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $avatar = new Avatar();
            $newUser = new User();
            $newUser->first_name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->avatar = $avatar->create($newUser->first_name)->toBase64();
            $newUser->password = bcrypt(request(Str::random()));
            $newUser->save();

            auth()->login($newUser, true);
        }

        return redirect()->intended('/dashboard');
    }
}
