<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    
    //Handle a success response
    public function successResponse(
        int $statusCode = Response::HTTP_OK,
        string $message = '',
        $result
    ): JsonResponse {

        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response, $statusCode);
    }

    //Handle a error Response
    public function errorResponse(
        int $statusCode = Response::HTTP_BAD_REQUEST,
        string $message = '',
        $error
    ): JsonResponse {

        $response = [
            'success' => false,
            'message' => $message,
            'data' => $error
        ];

        return response()->json($response, $statusCode);
    }

}
