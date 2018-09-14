<?php

namespace App\Http\Controllers;

use App\Whereabout;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhereaboutController extends Controller
{
    /**
     * Get the whereabouts of bus.
     * @throws \PDOException
     * @param App\Bus $bus
     * @return Json response
     **/
    public function location($bus)
    {
        $whereaboutModel = new Whereabout();
        $whereabouts     = $whereaboutModel->getLiveLocation($bus);
        return response()->json(['bus' => [
            'lat'  => (float)$whereabouts->lat,
            'lng'  => (float)$whereabouts->long,
            'time' => $whereabouts->updated_at
            ]
        ]);
    }

    /**
     * Store the whereabouts of bus.
     * @param App\Bus $bus
     * @param use  Illuminate\Http\Request $request
     * @return Json response
     **/
    public function store(Request $request, $bus)
    {
        $validator = $this->validateWhereaboutCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $data            = $this->castRequestData($request->all());
        $whereaboutModel = new Whereabout();
        try {
            $status= $whereaboutModel->store($bus->bus_no, $data);
        } catch (\Exception $e) {
            abort(401);
        }
        if ($status === "update") {
            return response()->json(['status' => 'updated whereabouts' ], 201);
        }
        return response()->json(['status' => 'inserted whereabouts' ], 201);
    }

    /**
    * Create the validator for storing whereabout.
    * @param array $data .
    * @return Illuminate\Support\Facades\Validator
    */
    protected function validateWhereaboutCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'lat'     => 'required|numeric',
                'long'    => 'required|numeric',
                'time'    => 'required|date_format:Y-m-d h:i:s'
            ]
        );
    }

    /**
    * Make data for database, use type casting
    * @param array $data .
    * @return array
    */
    protected function castRequestData($request)
    {
        return [
                'lat'  => (float) $request['lat'],
                'long' => (float) $request['long'],
                'time' => $request['time']
            ];
    }
}
