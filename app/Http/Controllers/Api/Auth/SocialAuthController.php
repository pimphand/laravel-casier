<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)  {
        // if(in_array($provider, ['facebook', 'google', 'github', 'linkedin', 'twitter'])){
        //     return response()->json(['error' => 'Provider not supported'], 400);
        // }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleCallback($provider){
        $user = Socialite::driver($provider)->user();
        return response()->json($user);
    }
}
