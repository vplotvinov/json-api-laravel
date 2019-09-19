<?php

/**
 * ONLY FOR BACKEND
 */
namespace App\Http\Controllers;

use App\Notifications\FeedbackNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification;

/**
 * Class FeedbackController
 * @package App\Http\Controllers
 */
class FeedbackController extends BaseController
{
    public function store(Request $request)
    {
        try {
            $data = $request->toArray();

            if ($_SERVER['SERVER_NAME'] === 'your_prod_server_name') {
                $data['slackChannel'] = '#channel1';
            } else {
                $data['slackChannel'] = '#channel2';
            }

            Notification::route('slack', env('SLACK_HOOK'))
                        ->notify(new FeedbackNotification($data));

            return response()->json(['status' => 'success'], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => 'error',
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }
}
