<?php

namespace App\Repository;

use App\Models\Programs;
use App\Models\Projects;
use DB;

class ProgramsRepository
{

    /**
     * @var Programs
     */
    private $programs;
    private $project;

    public function __construct(Programs $programs, Projects $project)
    {
        $this->programs = $programs;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->programs->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->programs->where('project_id', $project->id)->orderBy('id', 'desc')->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->programs->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->programs->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1)  || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id, $search = null)
    {
        $group_id = auth()->user()->user_group_id;
        $data= $this->programs->where('project_id',$proj_id)->orderBy('id','desc')->get();
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

    public function searchData($searchDetails)
    {
        $user_group= auth()->user()->user_group_id;
         $query= $this->programs->select('programs.*');
        if($user_group==2){
            $project_id = auth()->user()->project_id;
            $query->where('project_id',$project_id);
        }elseif($user_group==3){
            $region_id = auth()->user()->region_id;
            $projects = Projects::where('region_id', $region_id)->get();
            $projectId= [];
            foreach ($projects as $key => $value) {
                array_push($projectId,$value->id);
            }
            $query->whereIn('project_id',$projectId);
        }
        if($searchDetails!=null){
        if(isset($searchDetails['project_id']) && $searchDetails['project_id']!=null){
            $query->where('project_id',$searchDetails['project_id']);
        }
        if(isset($searchDetails['program_type_id']) && $searchDetails['program_type_id']!=null){
            $query->where('program_type_id',$searchDetails['program_type_id']);
        }
        if($searchDetails['from']!=null){
            $query->where('start_date','>=', $searchDetails['from']);
        }
        if($searchDetails['to']!=null){
            $query->where('end_date','<=', $searchDetails['to']);
        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $from= $searchDetails['from'];
            $to= $searchDetails['to'];
            // $query->whereBetween('start_date',[$from,$to]);
            $query->where('start_date','>=', $searchDetails['from']);
            $query->where('end_date','<=', $searchDetails['to']);
        }
    }
         $programs= $query->get();
         return $programs;
    }

    public function getProgramList($searchDetails)
    {
        $query= $this->programs->select('programs.*');
       if($searchDetails['project_id']!=null){
        $query->where('project_id',$searchDetails['project_id']);

       }
       if($searchDetails['year']!=null){
        $query->whereYear('start_date',$searchDetails['year']);

       }
       if($searchDetails['month']!=null){
        $query->whereMonth('start_date',$searchDetails['month']);

       }
       $programs=$query->get()->groupBy('program_type_id');
       return $programs;
       
    }

    public function getProgramsPerData($searchDetails)
    {
        $user_group= auth()->user()->user_group_id;
         $query= $this->programs->select('programs.*');
        if($user_group==2){
            $project_id = auth()->user()->project_id;
            $query->where('project_id',$project_id);
        }elseif($user_group==3){
            $region_id = auth()->user()->region_id;
            $projects = Projects::where('region_id', $region_id)->get();
            $projectId= [];
            foreach ($projects as $key => $value) {
                array_push($projectId,$value->id);
            }
            $query->whereIn('project_id',$projectId);
        }
        if($searchDetails['from']!=null){
            $query->where('start_date','>=', $searchDetails['from']);
        }
        if($searchDetails['to']!=null){
            $query->where('end_date','<=', $searchDetails['to']);
        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $from= $searchDetails['from'];
            $to= $searchDetails['to'];
            // $query->whereBetween('start_date',[$from,$to]);
            $query->where('start_date','>=', $searchDetails['from']);
            $query->where('end_date','<=', $searchDetails['to']);
        }
        $data=$query->select('project_id','program_type_id',\DB::raw('sum(bramin_f+dalit_f+janjati_f+others_f+muslim_f) as female_total'),
        \DB::raw('sum(bramin_m+dalit_m+janjati_m+others_m+muslim_m) as male_total'),
        \DB::raw('sum(bramin_f+dalit_f+janjati_f+others_f+muslim_f+bramin_m+dalit_m+janjati_m+others_m+muslim_m) as total'))
        ->groupBy('project_id','program_type_id')
        ->get()->groupBy('project_id');
        return $data;
    }

 
   
}
