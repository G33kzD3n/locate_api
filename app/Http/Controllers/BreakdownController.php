<?php

namespace App\Http\Controllers;

use App\Breakdown;
use Pusher\Pusher;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BreakdownController extends Controller
{
    public function store(Request $request, $bus)
    {
        $validator = $this->validateBreakdownCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $breakdownModel = new Breakdown();
        $status         = $breakdownModel->storeBreakdownInfo($bus->bus_no, $request->all());
        if ($status) {
            $this->sendNotification($bus->bus_no, 'breakdown-info-created', $request);
            return response()->json([
                'status'  => 'created',
                'message' => 'The Breakdown message has been saved successfully.'
            ], 201);
        }
    }

    public function sendNotification($channel, $event, $data)
    {
        $channel =(string)$channel.'-channel';
        $options = [
        'cluster' => 'ap2',
        'useTLS'  => true
        ];
        $pusher = new Pusher(
            'fc44950e09ecefa9effd',
            '662ca14e981599989a96',
            '603415',
            $options
        );
        $pusher->trigger($channel, $event, [
            'type' => (string) $data['type'],
            'time' => (string) $data['time']
        ]);
    }

    /**
    * Create the validator for storing breakdown message.
    * @param array $data .
    * @return Illuminate\Support\Facades\Validator
    */
    protected function validateBreakdownCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'type'        => 'required|string',
                'time'        => 'required|date_format:Y-m-d h:i:s'
            ]
        );
    }
}
