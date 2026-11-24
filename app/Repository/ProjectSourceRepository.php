<?php

namespace App\Repository;

use App\Models\ProjectSourceDetails;

class ProjectSourceRepository
{

    /**
     * @var BaseLine
     */
    private $sources_details;

    public function __construct(ProjectSourceDetails $sources_details)
    {
        $this->sources_details = $sources_details;
    }
    public function all()
    {
        $result = $this->sources_details->orderBy('id','desc')->get();
        return $result;

    }

    public function findByProjectId($p_id){
        $result= $this->sources_details->where('project_id',$p_id)->get();
        return $result;
    }

}