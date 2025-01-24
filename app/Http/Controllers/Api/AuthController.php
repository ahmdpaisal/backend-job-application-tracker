<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Services\Api\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseController
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
                return $this->errorResponse(401, 'Invalid credentials', []);
            }

            return $this->successResponse(200, 'Create token successfully', $result);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function logout(Request $request): JsonResponse {
        try {
            $this->authService->logout($request->user());

            return $this->successResponse(200, 'Logout successfully', []);
            
        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function currentUser(Request $request): JsonResponse {

        try {
            
            return $this->successResponse(200, 'Get user info successfully', $request->user());

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }

    }

}
