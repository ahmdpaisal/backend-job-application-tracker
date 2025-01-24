<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function rollback($e, $message = "Internal server error"){
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Internal server error"){
        Log::info($e);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $e->getMessage(),
        ], 500));
    }

    public static function sendResponse($code = 200, $message = '' , $result){
        $response=[
            'success' => true,
            'message' => $message,
            'payload' => $result,
        ];

        return response()->json($response, $code);
    }
}
