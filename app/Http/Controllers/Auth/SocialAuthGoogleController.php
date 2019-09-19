<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Overtrue\LaravelSocialite\Socialite;

class SocialAuthGoogleController extends AuthController
{
    /**
     * Redirect to google auth for login action
     *
     * @return mixed
     */
    public function redirect()
    {
        Session::put('auth_state', 'login');
        Session::save();

        return Socialite::driver('google')
                        ->redirect();
    }

    /**
     * Redirect to google auth for registration action
     *
     * @return mixed
     */
    public function redirectRegister()
    {
        Session::put('auth_state', 'registration');
        Session::save();

        return Socialite::driver('google')
                        ->redirect();
    }

    /**
     * @return RedirectResponse
     */
    public function callback()
    {
        try {
            $state      = Session::get('auth_state');
            $googleUser = Socialite::driver('google')->stateless()->user();

            if ($state === 'login') {
                return $this->loginOfGoogle($googleUser->toArray());
            }

            if ($state === 'registration') {
                return $this->registerOfGoogle($googleUser);
            }

            return response()->json(['status' => 'error', 'message' => 'session not founded']);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
