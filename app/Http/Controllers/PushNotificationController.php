<?php

namespace App\Http\Controllers;

use App\PushNotification;
use Pusher\Pusher;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

;

class PushNotificationController extends Controller
{
    public function store(Request $request)
    {
        $validator = $this->validatePushNotificationCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $pushNotifModel =  new PushNotification();
        $status         = $pushNotifModel->saveNotification($request->all());
        if ($status) {
            $this->sendNotification(
                'notifications',
                'notifications',
                [
                    'subject' => $request['subject'],
                    'message' => $request['message'],
                    'time'    => $request['time']
            ]
            );
        }
        return response()->json(['status' => 'Notification relayed to all users.']);
    }

    protected function validatePushNotificationCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'subject'  => 'required|string|max:190|min:10',
                'message'  => 'required|string',
                'time'     => 'required|date_format:Y-m-d h:i:s',
            ]
        );
    }

    public function sendNotification($channel, $event, $data)
    {
        $channel = (string)$channel . '-channel';
        $options = [
            'cluster' => 'ap2',
            'useTLS'  => true,
        ];
        $pusher = new Pusher(
            'fc44950e09ecefa9effd',
            '662ca14e981599989a96',
            '603415',
            $options
        );
        $pusher->trigger($channel, $event, $data);
    }
}
