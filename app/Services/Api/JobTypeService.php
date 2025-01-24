<?php

namespace App\Services\Api;

use App\Models\JobType;

class JobTypeService
{

    private function findById($id) {
        $jobType = JobType::find($id);
        
        return $jobType;
    }

    public function getJobTypes() {
        $jobTypes = JobType::orderBy('name', 'ASC')
            ->paginate(10);

        return $jobTypes;
    }

    public function createJobType($data) {
        $jobType = JobType::create($data);

        return $jobType;
    }

    public function getJobTypeById($id) {
        $jobType = $this->findById($id);

        if (!$jobType) {
            return null;
        }

        return $jobType;
    }

    public function updateJobType($data, $id) {
        $jobType = $this->findById($id);

        if (!$jobType) {
            return null;
        }

        $jobType->update($data);

        return $jobType;
    }

    public function deleteJobType($id) {
        $jobType = $this->findById($id);

        if (!$jobType) {
            return null;
        }

        $jobType->delete();

        return true;
    }

}