<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Services\Api\JobTypeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    
    protected $jobTypeService;

    public function __construct(JobTypeService $jobTypeService) {
        $this->jobTypeService = $jobTypeService;
    }
    
    public function index(): JsonResponse {

        try {

            $jobTypes = $this->jobTypeService->getJobTypes();

            return ApiResponseClass::sendResponse(
                200,
                'Job types fethed successfully',
                $jobTypes
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function store(Request $request): JsonResponse {

        try {

            $data = $request->only('name', 'description');

            $jobType = $this->jobTypeService->createJobType($data);

            return ApiResponseClass::sendResponse(
                201,
                'New job type created successfully',
                $jobType
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function show($id): JsonResponse {

        try {

            $jobType = $this->jobTypeService->getJobTypeById($id);

            if (!$jobType) {
                return ApiResponseClass::sendResponse(
                    404,
                    'Job type not found',
                    []
                );
            }

            return ApiResponseClass::sendResponse(
                200,
                'Job type fetch successfully',
                $jobType
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function update(Request $request, $id): JsonResponse {
        
        try {

            $data = $request->only('name', 'description');

            $jobType = $this->jobTypeService->updateJobType($data, $id);

            if (!$jobType) {
                return ApiResponseClass::sendResponse(
                    404,
                    'Job type not found',
                    []
                );
            }

            return ApiResponseClass::sendResponse(
                200,
                'Job type updated successfully',
                $jobType
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

    public function destroy($id): JsonResponse {
        try {

            $jobType = $this->jobTypeService->deleteJobType($id);

            if (!$jobType) {
                return ApiResponseClass::sendResponse(
                    404,
                    'Job type not found',
                    []
                );
            }

            return ApiResponseClass::sendResponse(
                200,
                'Job type deleted successfully',
                []
            );

        } catch (Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }

}
