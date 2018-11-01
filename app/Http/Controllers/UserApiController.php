<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    protected function validateRequestData ($request)
    {
        if ((int)$request['level'] == 0) {
            return $this->validateStudentCreds($request);
        } else if ((int)$request['level'] == 2) {
            return $this->validateCordinatorCreds($request);
        } else if ((int)$request['level'] == 1) {
            return $this->validateDriverCreds($request);
        } else {
            return response()
                ->json(['errors' => 'The level is not valid,level must be in set [0,1,2] only'], 422);
        }
    }

    protected function update (Request $request, User $user)
    {
        if (!$this->hasNewAvatar($request)) {
            //no new avatar update the user without avatar.
            $userModel = new User();
            $data = array_except($request->all(), ['_method', 'avatar']);
            $status = $userModel->updateUserWithoutAvatar($data, $user);
            if ($status instanceof \Exception) {
                return $status;
            }
        } else {
            //move new file to avatars
            try {
                $extension = $request->file('avatar')->guessClientExtension();
                $filename = time() . 'img.' . $extension;
                $request->file('avatar')->move('avatars', $filename);
                //remove previous file,
                if($user->avatar!=null){
                    unlink('avatars/' . $user->avatar);
                }
            } catch (\Exception $e) {
                //remove new uploaded image
                unlink('avatars/'.$filename);
                return $e;
            }
            $data = array_except($request->all(), ['_method']);
            $data['avatar'] = $filename;
            $userModel = new User();
            $status = $userModel->updateUserWithAvatar($data, $user);
            if ($status instanceof \Exception) {
                return $status;
            }
        }
    }

    protected function imageHasValidSize (Request $request)
    {
        if ($request->file('avatar')->getSize() <= 400000) {
            return true;
        }
        return false;
    }

    protected function isImage (Request $request)
    {
        try {
            $fileType = explode('/', $request->file('avatar')->getMimeType())[0];
            if ($fileType == 'image') {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return response()->json(['errors' => 'The avatar is not an image.'], 422);
        }

    }

    private function removeExistingAvatar (User $user)
    {
        try {
            unlink('avatars/' . $user->avatar);
        } catch (\Exception $e) {
            return $e;
        }
    }

    private function hasNewAvatar (Request $request)
    {
        if ($request->file('avatar') != null) {
            return true;
        }
        return false;
    }

    /**
     * Transform the user resource for api.
     * @param App\User $user .
     * @return array
     */
    protected function userTranform ($user)
    {
        $baseurl= env('APP_URL');
        return [
            "level"             => (int)$user->level,
            "name"              => (string)$user->name,
            "bus_no"            => (int)$user->bus_no,
            "dept_code"         => (string)$user->dept_id,
            "course_code"       => $user->course_id,
            "semester_level"    => $user->semester,
            "avatar"            => $baseurl.'/avatars/'.$user->avatar,
            "registration_date" => (string)$user->registered_on,
            "cell_no"           => (int)$user->phone_no,
            "stop"              => $user->stop != null ? [
                'name'    => $user->stop->name,
                'lat'     => (double)$user->stop->lat,
                'lng'     => (double)$user->stop->long,
                'stop_no' => (int)$user->stop->stops_order,
            ] : null,
        ];
    }

    /**
     * Create the validator for user.
     * @param array $data .
     * @return Illuminate\Support\Facades\Validator
     *  'name', 'username', 'password', 'level', 'phone_no', 'registered_on',
     * 'avatar', 'semester', 'course_id', 'dept_id', 'bus_no', 'stop_id'
     */
    protected function validateStudentCreds (array $data)
    {
        return Validator::make(
            $data,
            [
                'name'          => 'required|string',
                'username'      => 'required|numeric|digits_between:11,11',
                'level'         => 'required|numeric|digits_between:1,1',
                'phone_no'      => 'required|numeric|digits_between:10,10',
                'registered_on' => 'required|date_format:Y-m-d',
                'semester'      => 'required|numeric|digits_between:1,1',
                'course_id'     => 'required|string',
                'dept_id'       => 'required|string',
                'bus_no'        => 'required|numeric|digits_between:4,4',
                'stop_id'       => 'required|numeric',
            ]
        );
    }

    protected function validateCordinatorCreds( array $data)
    {
        return Validator::make(
            $data,
            [
                'name'          => 'required|string',
                'username'      => 'required|numeric|digits_between:11,11',
                'level'         => 'required|numeric|digits_between:1,1',
                'phone_no'      => 'required|numeric|digits_between:10,10',
                'registered_on' => 'required|date_format:Y-m-d',
                'dept_id'       => 'required|string',
                'bus_no'        => 'required|numeric|digits_between:4,4',
                'stop_id'       => 'required|numeric',
            ]
        );
    }

    protected function validateDriverCreds (array $data)
    {
        return Validator::make(
            $data,
            [
                'name'          => 'required|string',
                'username'      => 'required|numeric|digits_between:11,11',
                'level'         => 'required|numeric|digits_between:1,1',
                'phone_no'      => 'required|numeric|digits_between:10,10',
                'registered_on' => 'required|date_format:Y-m-d',
                'dept_id'       => 'required|string',
                'bus_no'        => 'required|numeric|digits_between:4,4',
                'stop_id'       => 'required|numeric',
            ]
        );
    }
}