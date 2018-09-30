<?php

namespace App\Http\Controllers;

use App\Breakdown;
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
            return response()->json([
                'status'  => 'created',
                'message' => 'The Breakdown message has been saved successfully.'
            ], 201);
        }
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
