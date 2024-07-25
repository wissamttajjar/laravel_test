<?php

namespace App\Http\Controllers\Application\sub;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\subscription_request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SendSubscriptionRequestController extends Controller
{
    use GeneralTrait;


    //send request subscription
    public function SendSubscribtionRequest(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'subscriber_type' => ['required'],
                'full_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
                'college' => ['required', 'alpha_dash'],
                'college_number' => ['required', 'numeric'],
                'phone' => ['required', 'regex:/^09\d{8}$/'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()_+!])[A-Za-z\d@#$%^&*()_+!]+$/'],

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->returnError('V422', $e->validator->errors()->first());
        }
        $sub_request = $request->all();
        $sub_request['password'] = Hash::make($sub_request['password']);
        $subscription = subscription_request::create($sub_request);
        return $this->returnSuccessMessage('تم ارسال الطلب بنجاح ');
    }



    public function Login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()_+!])[A-Za-z\d@#$%^&*()_+!]+$/'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->returnError($e->status, $e->validator->errors()->first());
        }
        ////////////

        $credentials = $request->only('email', 'password');

        $token = Auth::guard('subscriber-api')->attempt($credentials);
        if ($token == true) {
            $subscriber = Auth::guard('subscriber-api')->user();
            $subscriber['Token'] = $token;
            return $this->returnData('Subscriber', $subscriber, 'this is your data ');
        }
        $token2 = Auth::guard('driver-api')->attempt($credentials);
        if ($token2 == true) {
            $subscriber2 = Auth::guard('driver-api')->user();
            $subscriber2['Token'] = $token2;
            return $this->returnData('Subscriber', $subscriber2, 'this is your data ');
        }

        return $this->returnError('422', 'بيانات التسجيل غير صحيحة');
    }
}
