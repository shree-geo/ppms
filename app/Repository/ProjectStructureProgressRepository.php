<?php

namespace App\Repository;

use App\Models\StructureProgress;
use App\Models\Projects;
use Carbon\Carbon;

class ProjectStructureProgressRepository
{

    /**
     * @var StructureProgress
     */
    private $structure_progress;
    private $project;

    public function __construct(StructureProgress $structure_progress, Projects $project)
    {
        $this->structure_progress = $structure_progress;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->structure_progress->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy(['project_id','year','month']);
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
           $results=[];
            foreach ($projects as $project) {
                $data = $this->structure_progress->where('project_id',$project->id)->orderBy('id', 'desc')->get()->groupBy(['year','month']);
           
                if (!$data->isEmpty()) {
                    $results[$project->id]=$data;
                }
            }
        } else {
            $data = $this->structure_progress->orderBy('id', 'desc')->get();
            $results = $data->groupBy(['project_id','year','month']);
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->structure_progress->find($id);
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
        $data = $this->structure_progress->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
        // if ($search != null) {
        //     $result = $data->groupBy('project_id');
        //     return $result;
        // } else {
        //     return $data;
        // }
        $result=[];

        if($data->count()>0){
            $projects = $this->project->where('id', $data[0]->project_id)->first();
            if(($group_id == 2 && auth()->user()->project_id == $data[0]->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)){
                if($search!=null){
                  return $data->groupBy(['project_id','year','month']);
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

    public function findByStructureId($stru_id,$year_id,$month_id){
        $data=$this->structure_progress->where('structure_id',$stru_id)->where('year',$year_id)->where('month',$month_id)->first();
        return $data;
    }

    public function getByProjectYearMonth($proj_id,$year_id,$month_id){
        $result= $this->structure_progress->with('project')->where('project_id',$proj_id)->where('year',$year_id)->where('month',$month_id)->get();
        return $result;
    } 
      public function getByProjectYearMonthStrcuture($proj_id,$stru_id,$year_id,$month_id){
        $result= $this->structure_progress->where('project_id',$proj_id)->where('structure_id',$stru_id)->where('year',$year_id)->where('month',$month_id)->first();
        return $result;
    }

    public function getStructureProject($project_id)
    {
    $data=$this->structure_progress->where('project_id',$project_id)->select('structure_id',\DB::raw('sum(target) as target_total'),\DB::raw('sum(progress) as progress_total'),\DB::raw('sum(target_for_next_month) as target_for_next_month'))->groupBy('structure_id')->get()->groupBy('structure_id');
    return $data;

    }


    public function getProgress($searchDetails){

       $query= $this->structure_progress->select('structure_progress.*');

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
        //   $query->orWhere(function($query) use ($from_date){
        //       $query->where('year', $from_date->year)->where('month','>=', $from_date->month);
        //   });
        //   if($from_date->year<$to_date->year){
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('month','>=', $from_date->month);
        //       });
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('month','<=', $from_date->month);
        //       });
        // }
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
    $data=$query->select('structure_id','project_id',\DB::raw('sum(target) as target_total'),\DB::raw('sum(progress) as progress_total'),\DB::raw('sum(target_for_next_month) as target_for_next_month'))->groupBy('project_id','structure_id')->get()->groupBy(['project_id','structure_id']);
    return $data;
}
}
