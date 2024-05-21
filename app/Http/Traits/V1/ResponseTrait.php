<?php

namespace App\Http\Traits\V1;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
trait ResponseTrait {

    public function sendResponse($result, $message, $code)
    {
        $response['resultCode'] =  $code;
        $response['time'] =  date('Y-m-d H:i:s');
        $response['timeInMilliSecond'] = 1000 * strtotime(date('Y-m-d H:i:s'));
        $response['success'] =  [
            'title' => 'Success',
            'message' => $message,
        ];
        $response['data'] =  $result;
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages, $code = 404)
    {
        $response = [
            'resultCode' => $code,
            'time' => date('Y-m-d H:i:s'),
             'timeInMilliSecond' => 1000 * strtotime(date('Y-m-d H:i:s')),
        ];

        $response['error'] = [
            'title' => $error,
            'message' => $errorMessages,
        ];
        return response()->json($response, $code);
    }

    protected function responseWithToken($message, $result, $code = 200)
    {
        $response['resultCode'] =  $code;
        $response['time'] =  date('Y-m-d H:i:s');
        $response['timeInMilliSecond'] = 1000 * strtotime(date('Y-m-d H:i:s'));
        $response['success'] =  [
            'title' => 'Success',
            'message' => $message,
        ];
        $response['data'] =  $result;
        return response()->json($response, $code);
    }
}
