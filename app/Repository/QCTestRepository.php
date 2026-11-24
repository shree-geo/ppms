<?php

namespace App\Repository;

use App\Models\QCTest;
use App\Models\Projects;
use Carbon\Carbon;

class QCTestRepository
{

    /**
     * @var QCTest
     */
    private $qcTest;
    private $project;

    public function __construct(QCTest $qcTest, Projects $project)
    {
        $this->qcTest = $qcTest;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->qcTest->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->qcTest->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->qcTest->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->qcTest->find($id);
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
        $data = $this->qcTest->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
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
        $query= $this->qcTest->select('q_c_tests.*');
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

        if($searchDetails['project_id']!=null){
            $query->where('project_id',$searchDetails['project_id']);
        }
        if($searchDetails['qc_type_id']!=null){
            $query->where('test_type_id',$searchDetails['qc_type_id']);
        }
        if($searchDetails['test_location']!=null){
            $query->where('test_location',$searchDetails['test_location']);
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
         $qc_tests= $query->get();
         return $qc_tests;
    }

    public function getTestList($searchDetails)
    {
        $query= $this->qcTest->select('q_c_tests.*');
       if($searchDetails['project_id']!=null){
        $query->where('project_id',$searchDetails['project_id']);

       }
       if($searchDetails['year']!=null){
        $query->where('year',$searchDetails['year']);

       }
       if($searchDetails['month']!=null){
        $query->where('month',$searchDetails['month']);

       }
       $issue=$query->get()->groupBy('test_location');
       return $issue;
       
    }
    
}
