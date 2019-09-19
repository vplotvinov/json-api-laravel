<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class InviteController
 * @package App\Http\Controllers\Auth
 *
 * Need refactoring, separate logic by services
 */
class InviteController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

//    /**
//     * @var InviteService
//     */
//    protected $inviteService;
//
//    /**
//     * @var TokenService
//     */
//    protected $tokenService;
//
//    /**
//     * @var RequestValidationService
//     */
//    protected $rvs;
//
//    /**
//     * @var InviteValidator
//     */
//    protected $validator;
//
//    /**
//     * @var ResponseService
//     */
//    protected $responseService;
//
//    public function __construct(
//        InviteService $inviteService,
//        TokenService $tokenService,
//        RequestValidationService $rvs,
//        InviteValidator $validator,
//        ResponseService $responseService
//    ) {
//        $this->inviteService   = $inviteService;
//        $this->tokenService    = $tokenService;
//        $this->validator       = $validator;
//        $this->rvs             = $rvs;
//        $this->responseService = $responseService;
//    }
//
//    public function invite(Request $request)
//    {
//        try {
//            $emails        = $request->get('emails');
//            $postedInvites = [];
//
//            if ($emails) {
//                $emails = explode(',', $emails);
//
//                foreach ($emails as $email) {
//                    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
//                        $postedInvites[$email] = false;
//                        continue; // For send remaining emails
//                    }
//
//                    $inviteStatus          = $this->inviteService->sendInviteByEmail($email);
//                    $postedInvites[$email] = $inviteStatus;
//                }
//            } else {
//                throw new Exception('Emails is empty', 400);
//            }
//
//            return $this->responseService->sendSuccessResponse([
//                'emails' => $postedInvites,
//            ]);
//        } catch (Exception $e) {
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
//
//    // TODO: Maybe need move validate TokenService to InviteService, because bussines logic need save in InviteService
//    public function accept(Request $request)
//    {
//        try {
//            $token    = $request->get('token', '');
//            $fields   = $request->get('fields', []);
//            $tokenDto = $this->inviteService->acceptInviteFromEmail($token, $fields);
//
//            $existUser = UserModel::where('id', $tokenDto->getUserId())->with([
//                'account',
//                'role',
//            ])->first();
//
//            $token  = JWTAuth::fromUser($existUser);
//            $cookie = Cookie::make('token', $token, null, null, null, null, false);
//
//            if (empty($existUser['lastLoginAt'])) {
//                event(new FirstUserLogin($existUser->toArray()));
//            }
//
//            $existUser->update([
//                'lastLoginAt' => Carbon::now(),
//            ]);
//            $existUser->save();
//
//            return redirect()->to(config('app.frontend_app_url') . '/feed')->withCookie($cookie);
//
////            return $this->responseService->sendSuccessResponse($token, [], 'success', 200, $cookie);
//        } catch (Exception $e) {
////            return redirect()->to(config('app.website_app_url') . '/signin');
//
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
//
//    /**
//     * @param Request $request
//     *
//     * @return Response
//     */
//    public function acceptByAccountLink(Request $request)
//    {
//        try {
//            $request      = $this->rvs->setValidator($this->validator->setRequest($request))->validateGetRequest();
//            $email        = $request['email'];
//            $token        = $request['token'];
//            $fields       = $request['fields'] ?? [];
//            $tokenIsValid = $this->inviteService->acceptInviteByAccountLink($token, $email, $fields);
//
//            if ($tokenIsValid) {
//                return $this->responseService->sendSuccessResponse([
//                    'email'              => $email,
//                    'registrationStatus' => 'success',
//                ]);
//            } else {
//                throw new Exception('Token was expired', 403);
//            }
//        } catch (Exception $e) {
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
//
//    /**
//     * Generate invite link for account
//     */
//    public function getInviteLinkForAccount()
//    {
//        try {
//            $link = $this->inviteService->getInviteLinkForAccount();
//
//            return $this->responseService->sendSuccessResponse([
//                'inviteLink' => $link,
//            ]);
//        } catch (Exception $e) {
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
//
//
//    /**
//     * @return Response
//     */
//    public function storeInviteLinkForAccount()
//    {
//        try {
//            $link = $this->inviteService->createInviteLinkForAccount();
//
//            return $this->responseService->sendSuccessResponse([
//                'inviteLink' => $link,
//            ]);
//        } catch (Exception $e) {
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
//
//
//    /**
//     * @return Response
//     */
//    public function deleteInviteLinkForAccount()
//    {
//        try {
//            $isDeleteLink = $this->inviteService->deleteInviteLinkForAccount();
//
//            return $this->responseService->sendSuccessResponse([
//                'deletedInviteLink' => $isDeleteLink,
//            ]);
//        } catch (Exception $e) {
//            return $this->responseService->sendErrorResponse($e->getCode(), $e->getMessage());
//        }
//    }
}
