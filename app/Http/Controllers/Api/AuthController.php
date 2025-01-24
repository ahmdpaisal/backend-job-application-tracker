<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\Api\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    
    public function login(LoginRequest $request): JsonResponse {

        try {
            
            $credentials = $request->only('username', 'password', 'device');

            $result = $this->authService->login($credentials);

            if (!$result) {
                return ApiResponseClass::sendResponse(
                    401,
                    'Invalid credentials',
                    []
                );
            }

            return ApiResponseClass::sendResponse(
                200,
                'Create token successfully',
                $result
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function logout(Request $request): JsonResponse {
        try {
            $this->authService->logout($request->user());

            return ApiResponseClass::sendResponse(
                200,
                'Logout successfully',
                []
            );
            
        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function currentUser(Request $request): JsonResponse {

        try {
            
            return ApiResponseClass::sendResponse(
                200,
                'Get user info successfully',
                $request->user()
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }

    }

}
