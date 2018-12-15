<?php

namespace App\Http\Controllers;

use App\Fee;
use App\User;
use Illuminate\Http\Request;

class UserController extends UserApiController
{
    /**
     * Show a user resource.
     * @param User $user
     * @return Illuminate\Support\Facades\Response
     */
    public function index ()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        return response()->json(['data' =>
                                     array_map(function ($user) {
                                         return $this->allUsersTranform($user);
                                     }, $users->toArray()),
        ], 200);
    }

    public function show ($user)
    {
        return response()->json(['data' => $this->userTranform($user)], 200);
    }

    public function edit (Request $request, $user)
    {
        $validator = $this->validateRequestData($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if ($request['avatar'] != null) {
            if (!$this->isImage($request)) {
                return response()->json(['errors' => 'The avatar must be an image.'], 400);
            }
            if (!$this->imageHasValidSize($request)) {
                return response()->json(['errors' => 'The avatar size must under 400k only'], 400);
            }
        }
        //update user .
        $status = $this->update($request, $user);
        if ($status instanceof \Exception) {
            return response()->json(['errors' => $status->getMessage()], 400);
        }
        return response()->json(['status' => 'user updated successfully.'], 201);
    }

    public function showUnPaid ($user)
    {
        $feeModel = new Fee();
        $result = $feeModel->unPaid($user);
        $filteredData = [
            'name'             => $result->name,
            'monthly_fee'      => (int)$result->monthly_fee,
            'unpaid_months'    => (int)$result->un_paid_months,
            'total_unpaid_fee' => (int)$result->total_amount,
        ];

        return response()->json(['data' => $filteredData], 201);
    }

    public function changeBusDriver (Request $request, $bus, $user)
    {

//        $busModel = new Bus();
//        $previousDriver = $busModel->getDriver();
//        $status = $userModel->changeDriver($bus, $driver);
//        return $user
    }
}
