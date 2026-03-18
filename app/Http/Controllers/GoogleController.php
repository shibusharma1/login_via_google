<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // public function callback()
    // {
    //     $googleUser = Socialite::driver('google')->user();

    //     $user = User::updateOrCreate(
    //         ['email' => $googleUser->email],
    //         [
    //             'name' => $googleUser->name,
    //             'password' => bcrypt(Str::random(16)),
    //         ]
    //     );

    //     Auth::login($user);

    //     return redirect('/dashboard');
    // }
    
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
