<?php

namespace App\Repository;

use App\Models\Samitis;
use App\Models\Projects;

class MemberRepository
{

    /**
     * @var Samitis
     */
    private $member;
    private $project;

    public function __construct(Samitis $member, Projects $project)
    {
        $this->member = $member;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->member->where('project_id', $project_id)->orderBy('samiti_year', 'desc')->orderBy('position_id', 'asc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->member->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->member->orderBy('samiti_year', 'desc')->orderBy('position_id', 'asc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result= $this->member->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) ||($group_id==3 and auth()->user()->region_id==$projects->region_id) || ($group_id == 1)  || ($group_id == 4)) {
            return $result;
        }else{
            $result=null;
            return $result;
        }
    }
    public function getByProjectId($proj_id, $search = null)
    {
        $data = $this->member->where('project_id', $proj_id)->orderBy('samiti_year', 'desc')->orderBy('position_id', 'asc')->get();
        if ($search != null) {
            $result = $data->groupBy('project_id');
            return $result;
        } else {
            return $data;
        }
    }

    public function getSamitiCount()
    {
        $user_group= auth()->user()->user_group_id;
        $query= $this->member->select('samitits.*');
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
        $data= $query->select('project_id','member_gender',\DB::raw('count(member_gender) as gender_total'))->groupBy('project_id','member_gender')->get()->groupBy('project_id');
        return $data;
       
    }

    public function searchData($searchDetails)
    {
        $user_group= auth()->user()->user_group_id;
        $query= $this->member->select('samitis.*');
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
    }
    $query1=clone $query;
    $query2=clone $query;
    $query3=clone $query;
    $query4=clone $query;
    $query5=clone $query;
    $query6=clone $query;
    $data['cast_male']= $query1->select('project_id','member_cast_id',\DB::raw('count(member_cast_id) as cast_total'))->groupBy('project_id','member_cast_id')->where('member_gender','male')->get()->groupBy('project_id');
    $data['cast_female']= $query2->select('project_id','member_cast_id',\DB::raw('count(member_cast_id) as cast_total'))->groupBy('project_id','member_cast_id')->where('member_gender','female')->get()->groupBy('project_id');
    $data['key_male']= $query3->select('project_id','position_id',\DB::raw('count(position_id) as position_total'))->groupBy('project_id','position_id')->where('position_id','!=','6')->where('member_gender','male')->get()->groupBy('project_id');
    $data['key_female']= $query4->select('project_id','position_id',\DB::raw('count(position_id) as position_total'))->groupBy('project_id','position_id')->where('position_id','!=','6')->where('member_gender','female')->get()->groupBy('project_id');
    $data['excluded_group_male']= $query5->select('project_id',\DB::raw('count(excluded_group) as excluded_group'))->groupBy('project_id')->where('excluded_group','1')->where('member_gender','male')->get()->groupBy('project_id');
    $data['excluded_group_female']= $query6->select('project_id',\DB::raw('count(excluded_group) as excluded_group'))->groupBy('project_id')->where('excluded_group','1')->where('member_gender','female')->get()->groupBy('project_id');
    // dd($data);
    return $data;

    }

}