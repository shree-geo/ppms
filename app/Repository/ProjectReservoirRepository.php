<?php

namespace App\Repository;

use App\Models\ProjectReservoirs;

class ProjectReservoirRepository
{

    /**
     * @var BaseLine
     */
    private $reservoir_details;

    public function __construct(ProjectReservoirs $reservoir_details)
    {
        $this->reservoir_details = $reservoir_details;
    }
    public function all()
    {
        $result = $this->reservoir_details->orderBy('id','desc')->get();
        return $result;

    }

    public function findByProjectId($p_id){
        $result= $this->reservoir_details->where('project_id',$p_id)->get();
        return $result;
    }

}