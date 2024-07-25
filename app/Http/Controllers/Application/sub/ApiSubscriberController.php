<?php

namespace App\Http\Controllers\Application\sub;

use App\Models\trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\GeneralTrait;
use App\Models\subscriber_trip;

class ApiSubscriberController extends Controller
{
    use GeneralTrait;
    public function ShowTrip()
    {

        $trip = trip::get();
        return $this->returnData('trips', $trip, 'done');
    }

    public function Logout(Request $request)
    {
        $token = $request->header('auth_token');
        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate(); // invalidate the token.
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this->returnError('eror01', 'something rong');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        } else {
            return $this->returnError('CH01', 'you should login firstly');
        }
    }



    public function choosetrip(Request $request)
    {

        try {

            $trip = $request->only('subscriber_id', 'trip_id');
            $trip['QrCode'] = 'your_value'; // replace 'your_value' with the actual value
            $sub_trip = subscriber_trip::create($trip);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {


            return $this->returnError('T01', 'trip not found');
        }
        return $this->returnSuccessMessage('chose trip successfuly');
    }
}
