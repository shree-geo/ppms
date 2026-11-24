<?php


namespace App\Repository;


use App\Models\Issue;
use App\Models\Projects;

class IssueRepository
{

    public function __construct(Issue $issue, Projects $project)
    {
        $this->issue = $issue;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->issue->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->issue->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->issue->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->issue->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id,$search=null){
        $data= $this->issue->where('project_id',$proj_id)->orderBy('id','desc')->get();
        if($search!=null){
            $result= $data->groupBy('project_id');
            return $result;
        }else{
            return $data;

        }
    }
    public function searchData($searchDetails,$status=null)
    {
         $user_group= auth()->user()->user_group_id;
         $query= $this->issue->select('issues.*');
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
        if($searchDetails['from']!=null){
            $query->where('date','>=', $searchDetails['from']);
        }
        if($searchDetails['to']!=null){
            $query->where('date','<=', $searchDetails['to']);
        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $query->whereBetween('date',[$searchDetails['from'],$searchDetails['to']]);
        }
    }
    if($status=='summary'){
        $query1= clone $query;
           $issue['issue']=$query->where('category','issue')->get()->groupBy('project_id');
           $issue['meeting']=$query1->where('category','meeting')->get()->groupBy('project_id');
    } else{
          $issue= $query->get();

      }
         return $issue;
    }

    public function getIssueList($searchDetails)
    {
       $query= $this->issue->select('issues.*');
       if($searchDetails['project_id']!=null){
        $query->where('project_id',$searchDetails['project_id']);

       }
       if($searchDetails['year']!=null){
        $query->whereYear('date',$searchDetails['year']);

       }
       if($searchDetails['month']!=null){
        $query->whereMonth('date',$searchDetails['month']);

       }
       $issue=$query->get()->groupBy('category');
       return $issue;
       
    }
    
}