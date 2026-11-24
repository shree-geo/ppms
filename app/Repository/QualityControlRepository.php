<?php

namespace App\Repository;

use App\Models\QualityControl;
use App\Models\Projects;


class QualityControlRepository
{

    /**
     * @var QualityControl
     */
    private $qualityControl;
    private $project;

    public function __construct(QualityControl $qualityControl, Projects $project)
    {
        $this->qualityControl = $qualityControl;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->qualityControl->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->qualityControl->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->qualityControl->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->qualityControl->find($id);
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
        $group_id = auth()->user()->user_group_id;
        $data = $this->qualityControl->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
          $result=[];
        if($data->count()>0){
            $projects = $this->project->where('id', $data[0]->project_id)->first();
            if(($group_id == 2 && auth()->user()->project_id == $data[0]->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)){
                if($search!=null){
                  return $data->groupBy('project_id');
                }else{
                    return $data;
                }
            }else{
                return $result;
            }
            }else{
                return $result;
            }
    }

    public function getByqcTypeId($qcTypesId, $proId)
    {
        $data = $this->qualityControl->where('qc_type_id', $qcTypesId)->where('project_id', $proId)->first();
        return $data;
    }

   
}
