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
        $status         = $breakdownModel->storeBreakdownInfo($bus->bus_no, array_merge(['record_id'=> (int)$status],$request->all()));
        if ($status) {
            $this->sendNotification($bus->bus_no, 'breakdown-info-created', $request->all());
            return response()->json([
                'record_id'=> (int)$status,
                'status'   => 'created',
                'message'  => 'The Breakdown message has been saved successfully.'
            ], 201);
        }
    }

    /**
     * Update the breakdown information.
     * @param Request $request
     * @param Bus $bus
     * @param Breakdown $breakdown
     * @return mixed
     **/
    public function update(Request $request, $bus, $breakdown)
    {
        $validator = $this->validateUpdateBreakdownCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $breakdownModel = new Breakdown();
        $status         = $breakdownModel->updateBreakdownInfo($breakdown, $request->all());
        if ($status) {
            $this->sendNotification(
                $bus->bus_no,
                'breakdown-info-updated',
                ['message'=> $request['message'], 'time' =>$request['time']]
            );
            return response()->json([
                'status'  => 'updated',
                'message' => 'The Breakdown message has been updated for students successfully.'
            ], 200);
        } else {
            abort(404);
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
        $pusher->trigger($channel, $event, $data);
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

    protected function validateUpdateBreakdownCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'message'           => 'required|string',
                'time'              => 'required|date_format:Y-m-d h:i:s'
            ]
        );
    }
}
