<?php

namespace App\Repository;

use App\Models\ProjectDetails;

class ProjectDetailsRepository
{

    /**
     * @var BaseLine
     */
    private $project_detail;

    public function __construct(ProjectDetails $project_detail)
    {
        $this->project_detail = $project_detail;
    }
    public function all()
    {
        $result = $this->project_detail->orderBy('id','desc')->get();
        return $result;

    }

    public function findByProjectId($p_id){
        $result= $this->project_detail->where('project_id',$p_id)->first();
        return $result;
    }

}