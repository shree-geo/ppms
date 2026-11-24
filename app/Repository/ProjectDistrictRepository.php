<?php

namespace App\Repository;

use App\Models\ProjectDistrict;

class ProjectDistrictRepository
{

    /**
     * @var ProjectDistrict
     */
    private $project_district;

    public function __construct(ProjectDistrict $project_district)
    {
        $this->project_district = $project_district;
    }
    public function all()
    {
        $result = $this->project_district->orderBy('id','desc')->get();
        return $result->groupBy('project_id');

    }

    public function findByProjectId($id){
        $result= $this->project_district->where('project_id',$id)->get();
        return $result;
    }

}