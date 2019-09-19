<?php

namespace App\Http\Controllers\Auth;

use App\Events\AccountRegistration;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Services\Registration\AccountRegistrationService;
use App\Services\Registration\UserRegistrationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class RegisterController extends Controller
{
    protected $userRegistrationService;
    protected $accountRegistrationService;

    public function __construct(
        AccountRegistrationService $accountRegistrationService,
        UserRegistrationService $userRegistrationService
    ) {
        $this->userRegistrationService    = $userRegistrationService;
        $this->accountRegistrationService = $accountRegistrationService;
    }

    /**
     * Handle the incoming request.
     *
     * @param RegisterFormRequest $request
     *
     * @return Response
     */
    public function manualRegistration(RegisterFormRequest $request)
    {
        $accountData = [
            'title' => $request->get('email'),
        ];
        $accountData = $this->registerAccount($accountData);
        $userData    = [
            'email'     => $request->get('email'),
            'firstName' => $request->get('firstName', ''),
            'lastName'  => $request->get('lastName', ''),
            'avatarUrl' => $request->get('avatarUrl', null),
            'password'  => bcrypt($request->get('password')), // TODO: Think about best way for encryption password
        ];
        $userData    = $this->registerUser($userData, $accountData);

        event(new AccountRegistration($accountData));

        return response()->json([
            'message' => 'You were successfully registered. Now we send accept link on your email',
        ], 200);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function registerAccount(array $data): array
    {
        $registeredAccountData = $this->accountRegistrationService->registerAccount($data);

        return $registeredAccountData;
    }

    /**
     * @param array $data
     * @param array $account
     *
     * @return array
     */
    private function registerUser(array $data, array $account): array
    {
        $defaultUserData = [
            'userRoleId'     => Config::get('constants.userRoles.admin'),
            'userStatusId'   => Config::get('constants.userStatuses.pendingInvite'),
            'accountId'      => $account['id'],
            'outgoingPoints' => 100,
            'budgetPoints'   => 0,
        ];
        $userData        = $this->userRegistrationService->registerUser(
            array_merge($data, $defaultUserData)
        );

        return $userData;
    }

    public function registerOfGoogle($data)
    {
        $accountData = [
            'title' => $data['email'],
        ];
        $accountData = $this->registerAccount($accountData);
        $userData    = [
            'email'     => $data['email'],
            'firstName' => $data['original']['given_name'],
            'lastName'  => $data['original']['family_name'],
            'avatarUrl' => $data['avatar'],
            'password'  => null,
        ];
        $userData    = $this->registerUser($userData, $accountData);

        event(new AccountRegistration($accountData));

        return redirect()->to(config('app.website_app_url') . '/signin?status=success');
    }
}
