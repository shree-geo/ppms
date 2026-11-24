<?php

namespace App\Repository;

use App\Models\GrievanceCommunity;
use App\Models\Projects;


class GrievanceCommitteRepository
{

    /**
     * @var GrievanceCommunity
     */
    private $grievance_community;
    private $project;

    public function __construct(GrievanceCommunity $grievance_community, Projects $project)
    {
        $this->grievance_community = $grievance_community;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->grievance_community->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->grievance_community->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->grievance_community->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->grievance_community->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }
    // public function thirdlevel()
    // {
    //     $data= $this->grievance_community->where('level', 'third')->orderBy('id', 'desc')->get();
    //     return $data;
    // }
    public function getByProjectId($proj_id, $search = null)
    {
       
        $group_id = auth()->user()->user_group_id;
        $data = $this->grievance_community->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
          $result=[];
        if($data->count()>0){
            $projects = $this->project->where('id', $data[0]->project_id)->first();
            if(($group_id == 2 && auth()->user()->project_id == $data[0]->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)){
                if($search!=null){
                  return $data->groupBy('project_id');
                }else{
                    return $data->groupBy('level');
                }
            }else{
                return $result;
            }
            }else{
                return $result;
            }
    }

    
}
