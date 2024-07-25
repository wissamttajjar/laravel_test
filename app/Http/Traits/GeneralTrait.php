<?php

namespace App\Http\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "")
    {
        return [
            'status' => true,

            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value
        ]);
    }
}
