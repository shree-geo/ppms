<?php

namespace App\Repository;

use App\Models\Projects;

class ProjectRepository
{

    /**
     * @var Project
     */
    private $project;

    public function __construct(Projects $project)
    {
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $results = $this->project->with('address')->withCount('address')->where('id', $project_id)->get();
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $results = $this->project->with('address')->where('region_id', $region_id)->orderBy('id', 'desc')->get();
        } else {
            $results = $this->project->with('address')->withCount('address')->orderBy('id', 'desc')->get();
        }
        return $results;
    }

    public function findById($id)
    {

        $group_id = auth()->user()->user_group_id;
        $result = $this->project->with('address','reservior')->find($id);
        if (($group_id == 2 && auth()->user()->project_id == $id) || ($group_id == 3 && auth()->user()->region_id == $result->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }
    public function findByProject($id)
    {
        $group_id = auth()->user()->user_group_id;
        $data = $this->project->with('address')->where('id', $id)->get();
        $result=[];
        if($data->count()>0){
            if (($group_id == 2 && auth()->user()->project_id == $id) || ($group_id == 3 && auth()->user()->region_id == $data[0]->region_id) || ($group_id == 1) || ($group_id == 4)) {
                    return $data;
            }else{
                return $result;
            }
        }else{
            return $result;
        }
    }

    public function findByRegion($region_id)
    {
        $result =  $this->project->with('address')->where('region_id', $region_id)->get();
        return $result;
    }

    
}
