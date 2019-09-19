<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\Api\Auth\RegisterFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * @var RegisterController
     */
    protected $registerController;
    protected $loginController;
    protected $logoutController;

    /**
     * AuthController constructor.
     *
     * @param RegisterController $registerController
     * @param LoginController    $loginController
     * @param LogoutController   $logoutController
     */
    public function __construct(
        RegisterController $registerController,
        LoginController $loginController,
        LogoutController $logoutController
    ) {
        $this->registerController = $registerController;
        $this->loginController    = $loginController;
        $this->logoutController   = $logoutController;

        // TODO: Think about design, Login/Logout/Register service OR controller?
    }

    /**
     * @param array $data
     *
     * @return RedirectResponse
     */
    public function registerOfGoogle(array $data)
    {
        return $this->registerController->registerOfGoogle($data);
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    public function loginOfGoogle(array $data)
    {
        return $this->loginController->loginOfGoogle($data);
    }

    /**
     * @param RegisterFormRequest $request
     */
    public function manualRegistration(RegisterFormRequest $request)
    {
        $this->registerController->manualRegistration($request);
    }

}
