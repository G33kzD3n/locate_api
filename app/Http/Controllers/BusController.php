<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    public function index ()
    {
        $busModel = new Bus();
        $busNos = $busModel->getBusNos();
        $result = array_map(function ($bus_no) {
            $busModel = new Bus();
            return $this->busTransform(
                $bus_no,
                $busModel->getStopNames($bus_no),
                $busModel->getCoordinator($bus_no),
                $busModel->getDriver($bus_no)
            );
        }, $busNos->toArray());
        return response()->json(['buses' => $result], 201);
    }


    /**
     * Store a new bus.
     * @param Request $request
     * @return Bus|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $validator = $this->validateBusCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $busModel = new Bus();
        $status = $busModel->store($request->all());
        if($status instanceof  \Exception){
            return $status;
        }
        if($status instanceof  Bus){
            return response()->json(['status'=>'created'],201);
        }
    }

    public function edit(Request $request, $bus){
        $validator = Validator::make(
            $request->all(),
            [
                'bus_no'      => 'required|numeric|digits_between:4,4',
                'gps_device_id'      => 'required|string'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $busModel = new Bus();
        $status = $busModel->updateBus($bus,$request->all());
        if($status instanceof  \Exception){
            return $status;
        }
        if($status instanceof  Bus){
            return response()->json(['status'=>'updated'],201);
        }
    }

    /**
     * Show a bus resource.
     * @param $bus
     * @return \Illuminate\Http\JsonResponse
     */
    public function show ($bus)
    {
        $busModel = new Bus();
        $stops = $busModel->getStopNames($bus->bus_no);
        $busCoordinator = $busModel->getCoordinator($bus->bus_no);
        $busDriver = $busModel->getDriver($bus->bus_no);
        $result = $this->busTransform($bus->bus_no, $stops, $busCoordinator, $busDriver);
        return response()->json(['bus' => $result], 200);
    }

    public function showPassengers (Request $request, $bus)
    {
        $busModel = new Bus();
        $query = $request->query('groupby');
        if ($request->query('groupby') != null && $query == 'stopnames') {
            $data = $this->getPassengersByStop($busModel, $bus);
            return response()->json($data);
        }
        $passengers = $busModel->getPassengers($bus->bus_no);
        return response()->json(['passengers' => $this->passengerTransform($passengers)], 200);
    }

    protected function getPassengersByStop ($busModel, $bus)
    {
        $stopIds = $busModel->getStopIds($bus->bus_no);
        $data = [];
        $stops = $busModel->getStops($bus->bus_no);
        $index = 0;
        foreach ($stopIds as $id) {
            array_push(
                $data,
                [
                    'stop' => [
                        'name' => $stops[$index]['name'],
                        'stop_no' => $stops[$index]['stop_no'],
                        'lat' => (float)$stops[$index]['lat'],
                        'lng' => (float)$stops[$index]['lng'],
                        'passengers' =>
                            $this->passengerInfoTransform($busModel->getPassengersOfStop($id)),
                    ],
                ]
            );
            $index++;
        }
        return $data;
    }

    protected function busTransform ($bus_no, $stops, $busCoordinator, $busDriver)
    {
        return [
            'bus_no' => $bus_no,
            'driver' => [
                'name' => (string)$busDriver->name,
                'cell_no' => (int)$busDriver->phone_no,
            ],
            'cordinator' => [
                'name' => (string)$busCoordinator->name,
                'cell_no' => (int)$busCoordinator->phone_no,
                'department' => (string)$busCoordinator->dept_id,
            ],
            'stops' => [
                'names' => implode(array_map(function ($stop) {
                    return $stop[0];
                }, $stops), ';'),
                'latLngs' => array_map(function ($stop) {
                    return [
                        $stop[1], $stop[2],
                    ];
                }, $stops),
            ],
        ];
    }

    protected function passengerTransform ($passengers)
    {
        return array_map(function ($passenger) {
            return [
                'username' => (int)$passenger->username,
                'name' => $passenger->uname,
                'dept_code' => $passenger->dept_id,
                'course_code' => $passenger->course_id,
                'semester_level' => $passenger->semester,
                'avatar' => $passenger->avatar,
                'cell_no' => (int)$passenger->phone_no,
                'level' => $passenger->level,
                'stop' => [
                    'name' => $passenger->stopname,
                    'lat' => (float)$passenger->lat,
                    'lng' => (float)$passenger->long,
                    'stop_no' => (int)$passenger->stops_order,
                ],
            ];
        }, $passengers);
    }

    public function passengerInfoTransform ($passengers)
    {
        return array_map(function ($passenger) {
            return [
                'username' => (int)$passenger->username,
                'name' => $passenger->name,
                'dept_code' => $passenger->dept_id,
                'course_code' => $passenger->course_id,
                'semester_level' => (int)$passenger->semester,
                'avatar' => $passenger->avatar,
                'cell_no' => (int)$passenger->phone_no,
                'level' => (int)$passenger->level,
            ];
        }, $passengers);
    }
    /**
     * Create the validator for bus.
     * @param array $data .
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateBusCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'bus_no'      => 'required|numeric|unique:buses|digits_between:4,4',
                'gps_device_id'      => 'required|string|unique:buses'
            ]
        );
    }
}
