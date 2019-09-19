<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Services\Auth\Login as LoginService;
use App\Services\Auth\Token as TokenService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $tokenService;
    protected $loginService;

    public function __construct(TokenService $tokenService, LoginService $loginService)
    {
        $this->tokenService = $tokenService;
        $this->loginService = $loginService;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function manualLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ( ! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors'  => 'Unauthorised',
            ], 401);
        }

        return $this->generateToken();
    }

    /**
     * @return JsonResponse
     */
    private function generateToken()
    {
        $token                    = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addMonth();

        $token->token->save();

        return response()->json([
            'token_type'    => 'Bearer',
            'token'         => $token->accessToken,
            'refresh_token' => 'next time',
            'expires_at'    => Carbon::parse($token->token->expires_at)->toDateTimeString(),
        ], 200);
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    public function loginOfGoogle(array $data)
    {
        $user = UserModel::where('email', $data['email'])->first();

//        if ($user->userStatusId === config('constants.userStatuses.active')) TODO: Check user status ID
        Auth::login($user);

        $token = $this->generateToken();
        $token = http_build_query($token);

        return redirect(config('app.frontend_app_url') . '/callback/?' . $token);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function loginByMagicLink(Request $request)
    {
        try {
            $magicToken = $request->get('token', '');
            $user       = $this->loginService->getUserByMagicToken($magicToken);

            $this->tokenService->deleteToken($magicToken);

            $cookie = $this->loginUser($user);

            return redirect()->to(config('app.frontend_app_url') . '/feed')->withCookie($cookie);
        } catch (Exception $e) {
            return redirect()->to(config('app.website_app_url') . '/signin?error-message=error');
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function sendMagicLink(Request $request)
    {
        try {
            $email = $request->get('email', '');

            if (empty($email)) {
                throw new Exception('Email is empty', 400);
            }

            $this->loginService->generateMagicLink($email);

            return response()->json(['status' => 'success', 'message' => 'link was sent'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
