<?php

namespace App\Repository;

use App\Models\Grievance;
use App\Models\Projects;


class GrievanceRepository
{

    /**
     * @var Grievance
     */
    private $grievance;
    private $project;

    public function __construct(Grievance $grievance, Projects $project)
    {
        $this->grievance = $grievance;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->grievance->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->grievance->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->grievance->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->grievance->find($id);
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
        $data = $this->grievance->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
        if ($search != null) {
            $result = $data->groupBy('project_id');
            return $result;
        } else {
            return $data;
        }
    }
    public function searchData($searchDetails)
    {
         $user_group= auth()->user()->user_group_id;
         $query= $this->grievance->select('grievances.*');
        if($user_group==2){
            $project_id = auth()->user()->project_id;
            $query->where('project_id',$project_id);
        }elseif($user_group==3){
            $region_id = auth()->user()->region_id;
            $grievances = $this->project->where('region_id', $region_id)->get();
            $projectId= [];
            foreach ($grievances as $key => $value) {
                array_push($projectId,$value->id);
            }
            $query->whereIn('project_id',$projectId);
        }
    if($searchDetails!=null){
        if($searchDetails['project_id']!=null){
            $query->where('project_id',$searchDetails['project_id']);
        }
        if($searchDetails['from']!=null){
            $query->where('complain_date','>=', $searchDetails['from']);
        }
        if($searchDetails['to']!=null){
            $query->where('complain_date','<=', $searchDetails['to']);
        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $query->whereBetween('complain_date',[$searchDetails['from'],$searchDetails['to']]);
        }
    }
         $grievances= $query->get();
         return $grievances;
    }

    public function findgrievanceRecord($searchDetails)
    {
        $user_group= auth()->user()->user_group_id;
         $query= $this->grievance->select('grievances.*');
        if($user_group==2){
            $project_id = auth()->user()->project_id;
            $query->where('project_id',$project_id);
        }elseif($user_group==3){
            $region_id = auth()->user()->region_id;
            $grievances = $this->project->where('region_id', $region_id)->get();
            $projectId= [];
            foreach ($grievances as $key => $value) {
                array_push($projectId,$value->id);
            }
            $query->whereIn('project_id',$projectId);
        }
        if($searchDetails['from']!=null){
            $query->where('complain_date','>=', $searchDetails['from']);
        }
        if($searchDetails['to']!=null){
            $query->where('complain_date','<=', $searchDetails['to']);
        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $query->whereBetween('complain_date',[$searchDetails['from'],$searchDetails['to']]);
        }
        $query1=clone $query;
        $query2=clone $query;
        $data['total']=$query->select('project_id',\DB::raw('count(issue) as total'))->groupBy('project_id')->get()->groupBy('project_id');
        $data['solved']=$query1->where('current_status','solved')->select('project_id',\DB::raw('count(id) as total'))->groupBy('project_id')->get()->groupBy('project_id');
        $data['data']=$query2->get()->groupBy('project_id');
       return $data;
    }

}