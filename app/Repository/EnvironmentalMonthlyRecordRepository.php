<?php

namespace App\Repository;

use App\Models\EnvironmentalMonthlyRecord;
use App\Models\Projects;
use Carbon\Carbon;



class EnvironmentalMonthlyRecordRepository
{

    /**
     * @var EnvironmentalMonthlyRecord
     */
    private $environment_record;
    private $project;

    public function __construct(EnvironmentalMonthlyRecord $environment_record, Projects $project)
    {
        $this->environment_record = $environment_record;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->environment_record->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy(['project_id','year','month']);
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->environment_record->where('project_id', $project->id)->get()->groupBy(['year','month']);
                if (!$data->isEmpty()) {
                    $results[$project->id]= $data;
                }
            }
        } else {
            $data = $this->environment_record->orderBy('id', 'desc')->get();
            $results = $data->groupBy(['project_id','year','month']);
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->environment_record->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id,$search=null)
    {
        $group_id = auth()->user()->user_group_id;
        $data = $this->environment_record->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
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
    public function getByprojectYear($proj_id,$year,$month){
        $data= $this->environment_record->where('project_id',$proj_id)->where('year',$year)->where('month',$month)->get();
        return $data->groupBy('env_group_id');
    }
    public function getByproject($proj_id,$year,$month){
        $data= $this->environment_record->where('project_id',$proj_id)->where('year',$year)->where('month',$month)->get();
        return $data;
    }

    public function findByGroupId($proj_id,$group_id,$year,$month){
        $data= $this->environment_record->where('project_id',$proj_id)->where('env_group_id',$group_id)->where('year',$year)->where('month',$month)->first();
        return $data;
    }

    public function searchData($searchDetails)
    {
       
        $user_group= auth()->user()->user_group_id;
        $query= $this->environment_record->select('environmental_monthly_records.*');
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
          if($searchDetails['project_id']!=null){
            $query->where('project_id',$searchDetails['project_id']);
        }
        if($searchDetails['from']!=null && $searchDetails['to']==null){
            $from_date=new Carbon($searchDetails['from']);
          $query->where(function($query) use ($from_date){
              $query->where('year', $from_date->year)->where('month','>=', $from_date->month);
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('month','>=', $from_date->month);
              });
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('month','<=', $from_date->month);
              });
          });
         

      }
      if($searchDetails['to']!=null && $searchDetails['from']==null){
          $to_date= new Carbon($searchDetails['to']);
          $query->where(function($query) use ($to_date){
              $query->where('year', $to_date->year)->where('month','<=', $to_date->month);
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('month','>=', $to_date->month);
              });
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('month','<=', $to_date->month);
              });
          });
      }
      if($searchDetails['to']!=null && $searchDetails['from']!=null){
          $from_date=new Carbon($searchDetails['from']);
          $to_date=new Carbon($searchDetails['to']);
          if($from_date->year==$to_date->year){
            $query->whereBetween('year',[$from_date->year,$to_date->year])->whereBetween('month',[$from_date->month,$to_date->month]);

      }else{
        //   $query->where(function($query) use ($from_date){
        //       $query->where('year', $from_date->year)->where('month','>=', $from_date->month);
        //   });
        // //   if($from_date->year<$to_date->year){
        // //       $query->orWhere(function($query) use ($from_date){
        // //           $query->where('year','>', $from_date->year)->where('month','>=', $from_date->month);
        // //       });
        // //       $query->orWhere(function($query) use ($from_date){
        // //           $query->where('year','>', $from_date->year)->where('month','<=', $from_date->month);
        // //       });
        // //     }
        
        //   $query->orWhere(function($query) use ($to_date){
        //       $query->where('year', $to_date->year)->where('month','<=', $to_date->month);
        //   });

        $query->where(function($query) use ($from_date, $to_date){
            $query->where('year', $from_date->year)->where('month','>=', $from_date->month);
            if($from_date->year<$to_date->year){
            $query->orWhere(function($query) use ($from_date){
                $query->where('year','>', $from_date->year)->where('month','>=', $from_date->month);
            });
            $query->orWhere(function($query) use ($from_date){
                $query->where('year','>', $from_date->year)->where('month','<=', $from_date->month);
            });
        }
              $query->where('year', $to_date->year)->where('month','<=', $to_date->month);

        });
      }
       
      }
        $result= $query->orderBy('id', 'desc')->get();
        return $result;
    }
}
