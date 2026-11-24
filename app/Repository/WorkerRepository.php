<?php

namespace App\Repository;

use App\Models\WorkerDetails;
use App\Models\Projects;
use Carbon\Carbon;



class WorkerRepository
{

    /**
     * @var WorkerDetails
     */
    private $worker;
    private $project;

    public function __construct(WorkerDetails $worker, Projects $project)
    {
        $this->worker = $worker;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->worker->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results=[];
            foreach ($projects as $project) {
                $data = $this->worker->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->worker->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->worker->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function findByYearMonth($project_id,$year,$month){
        $data=$this->worker->where('project_id',$project_id)->where('year',$year)->where('month',$month)->get();
        return $data;

    }
    

    public function getByProjectId($proj_id,$search=null){
        
        $group_id = auth()->user()->user_group_id;
        $data= $this->worker->where('project_id',$proj_id)->orderBy('id','desc')->get();
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

    public function searchData($searchDetails,$status=null)
    {
         $user_group= auth()->user()->user_group_id;
         $query= $this->worker->select('worker_details.*');
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
        //     }
        
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
    }
    if($status=='summary'){
        $query->select('project_id',
        \DB::raw('sum(bramin_f) as bramin_f '),
        \DB::raw('sum(bramin_m) as bramin_m'),
        \DB::raw('sum(dalit_f) as dalit_f'),
        \DB::raw('sum(dalit_m) as dalit_m'),
        \DB::raw('sum(janjati_m) as janjati_m '),
        \DB::raw('sum(janjati_f) as janjati_f '),
        \DB::raw('sum(muslim_f) as muslim_f '),
        \DB::raw('sum(muslim_m) as  muslim_m'),
        \DB::raw('sum(others_f) as others_f '),
        \DB::raw('sum(others_m) as others_m '),
        \DB::raw('sum(skill_female) as skill_female '),
        \DB::raw('sum(skill_male) as skill_male'),
        \DB::raw('sum(unskill_female) as unskill_female'),
        \DB::raw('sum(unskill_male) as unskill_male'),
    )->groupBy('project_id');
    }
        $workers= $query->get();

         return $workers;
    }

    public function getWorkerList($searchDetails)
    {
        $query= $this->worker->select(\DB::raw('bramin_f + bramin_m + dalit_f+dalit_m+janjati_m+janjati_f+muslim_f+muslim_m+others_f+others_m as total') );
        // ->select('sum() as skilled_total, sum(unskill_bramin_f + unskill_bramin_m + unskill_dalit_f+unskill_dalit_m+unskill_janjati_m+unskill_janjati_f+unskill_muslim_f+unskill_muslim_m+unskill_others_f+unskill_others_m) as unskilled_total' );
       if($searchDetails['project_id']!=null){
        $query->where('project_id',$searchDetails['project_id']);

       }
       if($searchDetails['year']!=null){
        $query->where('year',$searchDetails['year']);

       }
       if($searchDetails['month']!=null){
        $query->where('month',$searchDetails['month']);

       }
       $workers=$query->get();
       return $workers;
       
    }



}