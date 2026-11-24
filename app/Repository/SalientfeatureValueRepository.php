<?php

namespace App\Repository;

use App\Models\FeaturesValue;
use App\Models\Projects;


class SalientfeatureValueRepository
{

    /**
     * @var FeaturesValue
     */
    private $feature_value;
    private $project;

    public function __construct(FeaturesValue $feature_value, Projects $project)
    {
        $this->feature_value = $feature_value;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->feature_value->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data;
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->feature_value->where('project_id', $project->id)->orderBy('id', 'desc')->get();
                if (!$data->isEmpty()) {
                    $results= $data;
                }
            }
        } else {
            $data = $this->feature_value->orderBy('id', 'desc')->get();
            $results = $data;
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->feature_value->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id, $search = null)
    {
        $data = $this->feature_value->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
        if ($search != null) {
            $result = $data->groupBy('project_id');
            return $result;
        } else {
            return $data;
        }
    }

    public function findByStructureId($stru_id,$project_id){
        $data=$this->feature_value->where('sailent_feature_id',$stru_id)->where('project_id',$project_id)->first();
        return $data;
    }

    
}
