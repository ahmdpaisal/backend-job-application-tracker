<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Services\Api\JobTypeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobTypeController extends BaseController
{
    
    protected $jobTypeService;

    public function __construct(JobTypeService $jobTypeService) {
        $this->jobTypeService = $jobTypeService;
    }
    
    public function index(): JsonResponse {

        try {

            $jobTypes = $this->jobTypeService->getJobTypes();

            return $this->successResponse(200, 'Job Types fetched successfully', $jobTypes);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function store(Request $request): JsonResponse {

        try {

            $data = $request->only('name', 'description');

            $jobType = $this->jobTypeService->createJobType($data);

            return $this->successResponse(201, 'New job type created successfully', $jobType);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function show($id): JsonResponse {

        try {

            $jobType = $this->jobTypeService->getJobTypeById($id);

            if (!$jobType) {
                return $this->errorResponse(404, 'Job type not found', []);
            }

            return $this->successResponse(200, 'Job type fetch successfully', $jobType);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function update(Request $request, $id): JsonResponse {
        
        try {

            $data = $request->only('name', 'description');

            $jobType = $this->jobTypeService->updateJobType($data, $id);

            if (!$jobType) {
                return $this->errorResponse(404, 'Job type not found', []);
            }

            return $this->successResponse(200, 'Job type updated successfully', $jobType);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse {
        try {

            $jobType = $this->jobTypeService->deleteJobType($id);

            if (!$jobType) {
                return $this->errorResponse(404, 'Job type not found', []);
            }

            return $this->successResponse(200, 'Job type deleted successfully', []);

        } catch (Exception $e) {
            return $this->errorResponse(500, 'Internal server error', $e->getMessage());
        }
    }

}
