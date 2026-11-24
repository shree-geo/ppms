<?php

namespace App\Repository;

use App\Models\ProgressData;
use App\Models\Projects;
use App\Models\Scurve;
use Carbon\Carbon;

class ProgressDataRepository
{

    /**
     * @var ProgressData
     */
    private $progressData;
    private $project;
    private $scurve;

    public function __construct(ProgressData $progressData, Projects $project, Scurve $scurve)
    {
        $this->progressData = $progressData;
        $this->project = $project;
        $this->scurve = $scurve;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->progressData->where('project_id', $project_id)->orderBy('id', 'asc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->progressData->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->progressData->orderBy('id', 'asc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->progressData->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getTargetByProjectId($proj_id)
    {
        $data = $this->progressData->where('project_id', $proj_id)->get();
        return $data;
    }
    public function latestData($proj_id)
    {
        $data = $this->progressData->where('project_id', $proj_id)->get();
        return $data;
    }
    public function getProgressByProjectId($proj_id)
    {
        $data = $this->progressData->where('project_id', $proj_id)->whereNotNull('progress')->get();
        return $data;
        
    }

    public function getByRevision($revision,$project_id,$status=false){
          $data = $this->progressData->where('revision',$revision)->where('project_id',$project_id)->get();
          if($status==true){
              return $data->groupBy('year');
          }else{
              return $data;
          }
    }

    public function getByProjectId($project_id){
        $data = $this->progressData->where('project_id',$project_id)->get();
        return $data->groupBy('year');
        
    }


    public function findProgrssData($searchDetails){
        $query= $this->progressData->select('progress_data.*');
        if($searchDetails['from']!=null && $searchDetails['to']==null){
            $from_date=new Carbon($searchDetails['from']);
          $query->where(function($query) use ($from_date){
              $query->where('year', $from_date->year)->where('month_code','>=', $from_date->month);
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('month_code','>=', $from_date->month);
              });
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('month_code','<=', $from_date->month);
              });
          });
         

      }
      if($searchDetails['to']!=null && $searchDetails['from']==null){
          $to_date= new Carbon($searchDetails['to']);
          $query->where(function($query) use ($to_date){
              $query->where('year', $to_date->year)->where('month_code','<=', $to_date->month);
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('month_code','>=', $to_date->month);
              });
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('month_code','<=', $to_date->month);
              });
          });
      }
      if($searchDetails['to']!=null && $searchDetails['from']!=null){
          $from_date=new Carbon($searchDetails['from']);
          $to_date=new Carbon($searchDetails['to']);
          if($from_date->year==$to_date->year){
            $query->whereBetween('year',[$from_date->year,$to_date->year])->whereBetween('month_code',[$from_date->month,$to_date->month]);

      }else{
        //   $query->orWhere(function($query) use ($from_date){
        //       $query->where('year', $from_date->year)->where('month_code','>=', $from_date->month);
        //   });
        //   if($from_date->year<$to_date->year){
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('month_code','>=', $from_date->month);
        //       });
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('month_code','<=', $from_date->month);
        //       });
        // }
        //   $query->orWhere(function($query) use ($to_date){
        //       $query->where('year', $to_date->year)->where('month_code','<=', $to_date->month);
        //   });

        $query->where(function($query) use ($from_date, $to_date){
            $query->where('year', $from_date->year)->where('month_code','>=', $from_date->month);
            if($from_date->year<$to_date->year){
                $query->orWhere(function($query) use ($from_date){
                    $query->where('year','>', $from_date->year)->where('month_code','>=', $from_date->month);
                });
                $query->orWhere(function($query) use ($from_date){
                    $query->where('year','>', $from_date->year)->where('month_code','<=', $from_date->month);
                });
        }
              $query->where('year', $to_date->year)->where('month_code','<=', $to_date->month);

        });
      }
    

    }

    $data= $query->select('project_id',\DB::raw('sum(target) as target_total'),\DB::raw('sum(progress) as progress_total'),\DB::raw('sum(financial_progress) as financial_total'))->groupBy('project_id')->get()->groupBy('project_id');
    return $data;
}


public function getScurveData($project_id)
{
   $data=$this->scurve->where('project_id',$project_id)->get()->groupBy(['revision_name']);
   return $data;
}


public function getRecentMonthData($recent_month,$year)
{
    $group_id = auth()->user()->user_group_id;
    if ($group_id == 2) {
        $project_id = auth()->user()->project_id;
        $data = $this->progressData->select('project_id','target','progress')->where('project_id', $project_id)->where('year',$year)->where('month_code',$recent_month)->orderBy('id', 'asc')->get();
        $results = $data->groupBy('project_id');
    } elseif ($group_id == 3) {
        $region_id = auth()->user()->region_id;
        $projects = $this->project->where('region_id', $region_id)->get();
        $results = [];
        foreach ($projects as $project) {
            $data = $this->progressData->select('project_id','target','progress')->where('project_id', $project->id)->where('year',$year)->where('month_code',$recent_month)->get();
            if (!$data->isEmpty()) {
                $results[$project->id] = $data;
            }
        }
    } else {
        $data = $this->progressData->select('project_id','target','progress')->where('year',$year)->where('month_code',$recent_month)->orderBy('id', 'asc')->get();
        $results = $data->groupBy('project_id');
    }
    return $results;
}

function findFinancialProgressData($searchDetails=null){

        $query= $this->progressData->select('progress_data.*');
        if(isset($searchDetails['year']) && $searchDetails['year']!=null){
              $query->where('year', $searchDetails['year']);

      }
        if(isset($searchDetails['month']) &&$searchDetails['month']!=null ){
              $query->where('month_code', $searchDetails['month']);

      }

    $data= $query->select('project_id',\DB::raw('sum(target) as target_total'),\DB::raw('sum(progress) as progress_total'),\DB::raw('sum(financial_progress) as financial_total'))->groupBy('project_id')->get()->groupBy('project_id');
    return $data;
}

public function getProgressData($project_id,$year,$month){
    $data = $this->progressData->where('project_id',$project_id)->where('year',$year)->where('month',$month)->whereNull('rid')->first();
    return $data;

}
   

}