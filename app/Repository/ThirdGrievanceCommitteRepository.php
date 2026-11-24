<?php

namespace App\Repository;

use App\Models\Projects;
use App\Models\ThirdLevelGrievance;

class ThirdGrievanceCommitteRepository
{

    /**
     * @var ThirdLevelGrievance
     */
    private $thirdLevel_grievance;
    private $project;

    public function __construct(ThirdLevelGrievance $thirdLevel_grievance, Projects $project)
    {
        $this->thirdLevel_grievance = $thirdLevel_grievance;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
     
            $data = $this->thirdLevel_grievance->get();
       
        return $data;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->thirdLevel_grievance->find($id);
        
        return $result;
    }
    

    
}
