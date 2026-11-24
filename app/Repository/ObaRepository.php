<?php

namespace App\Repository;

use App\Models\Oba;
use App\Models\Projects;
use Carbon\Carbon;
use DB;

class ObaRepository
{

    /**
     * @var oba
     */
    private $oba;
    private $project;

    public function __construct(oba $oba, Projects $project)
    {
        $this->oba = $oba;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->oba->with('details')->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->oba->with('details')->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->oba->with('details')->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->oba->find($id);
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
        $data = $this->oba->with('details')->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
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
       $query= $this->oba->with('details')->select('obas.*');
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
        if($searchDetails['oba_types_id']!=null){
            $query->where('oba_types_id',$searchDetails['oba_types_id']);
        }
        if(isset($searchDetails['dis_id']) && $searchDetails['dis_id']!=null){
            $query->where('dis_id',$searchDetails['dis_id']);
        }
        if($searchDetails['from']!=null && $searchDetails['to']==null){
            $from_date=new Carbon($searchDetails['from']);
          $query->where(function($query) use ($from_date){
              $query->where('year', $from_date->year)->where('months','>=', $from_date->month);
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('months','>=', $from_date->month);
              });
              $query->orWhere(function($query) use ($from_date){
                  $query->where('year','>', $from_date->year)->where('months','<=', $from_date->month);
              });
          });
         

      }
      if($searchDetails['to']!=null && $searchDetails['from']==null){
          $to_date= new Carbon($searchDetails['to']);
          $query->where(function($query) use ($to_date){
              $query->where('year', $to_date->year)->where('months','<=', $to_date->month);
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('months','>=', $to_date->month);
              });
              $query->orWhere(function($query) use ($to_date){
                  $query->where('year','<', $to_date->year)->where('months','<=', $to_date->month);
              });
          });
      }
      if($searchDetails['to']!=null && $searchDetails['from']!=null){
          $from_date=new Carbon($searchDetails['from']);
          $to_date=new Carbon($searchDetails['to']);
          if($from_date->year==$to_date->year){
            $query->whereBetween('year',[$from_date->year,$to_date->year])->whereBetween('months',[$from_date->month,$to_date->month]);

      }else{
        //   $query->orWhere(function($query) use ($from_date){
        //       $query->where('year', $from_date->year)->where('months','>=', $from_date->month);
        //   });
        //   if($from_date->year<$to_date->year){
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('months','>=', $from_date->month);
        //       });
        //       $query->orWhere(function($query) use ($from_date){
        //           $query->where('year','>', $from_date->year)->where('months','<=', $from_date->month);
        //       });
        // }
        //   $query->orWhere(function($query) use ($to_date){
        //       $query->where('year', $to_date->year)->where('months','<=', $to_date->month);
        //   });
        $query->where(function($query) use ($from_date, $to_date){
            $query->where('year', $from_date->year)->where('months','>=', $from_date->month);
            if($from_date->year<$to_date->year){
                $query->orWhere(function($query) use ($from_date){
                    $query->where('year','>', $from_date->year)->where('months','>=', $from_date->month);
                });
                $query->orWhere(function($query) use ($from_date){
                    $query->where('year','>', $from_date->year)->where('months','<=', $from_date->month);
                });
        }
              $query->where('year', $to_date->year)->where('months','<=', $to_date->month);

        });
      }
       
      }
    }
    if($status=='report'){
        $obas= $query->get()->groupBy(['project_id','year','months']);
    }else{
        $obas= $query->get();
    }

         
         return $obas;
    }

    public function reportData($searchDetails)
    {
        
        $user_group= auth()->user()->user_group_id;
       $query=$this->oba->join('oba_details','oba_details.obas_id','obas.id');
       $query1=clone $query;
       $query->select('obas.*','oba_details.*',
                DB::raw('(Case When oba_details.start_date is not null THEN "yes" ELSE "no" END) as start_status'),
                DB::raw('(Case When oba_details.complete_date is not null THEN "yes" ELSE "no" END) as complete_status'),
                DB::raw('(Case When oba_details.inuse_date is not null THEN "yes" ELSE "no" END) as inuse_status'));

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
        if($searchDetails['oba_types_id']!=null){
            $query->where('oba_types_id',$searchDetails['oba_types_id']);
        }
        if(isset($searchDetails['dis_id']) && $searchDetails['dis_id']!=null){
            $query->where('dis_id',$searchDetails['dis_id']);
        }
        if($searchDetails['from']!=null){
            $query->select('obas.*','oba_details.*',
            DB::raw('(Case When oba_details.start_date >= "'.$searchDetails['from'].'" THEN "yes" ELSE "no" END) as start_status'),
            DB::raw('(Case When oba_details.complete_date >= "'.$searchDetails['from'].'" THEN "yes" ELSE "no" END) as complete_status'),
            DB::raw('(Case When oba_details.inuse_date >= "'.$searchDetails['from'].'" THEN "yes" ELSE "no" END) as inuse_status'));
            
        }
        if($searchDetails['to']!=null){
            $query->select('obas.*','oba_details.*',
            DB::raw('(Case When oba_details.start_date <= "'.$searchDetails['to'].'" THEN "yes" ELSE "no" END) as start_status'),
            DB::raw('(Case When oba_details.complete_date <= "'.$searchDetails['to'].'" THEN "yes" ELSE "no" END) as complete_status'),
            DB::raw('(Case When oba_details.inuse_date <= "'.$searchDetails['to'].'" THEN "yes" ELSE "no" END) as inuse_status'));

        }
        if($searchDetails['to']!=null && $searchDetails['from']!=null){
            $from= $searchDetails['from'];
            $to= $searchDetails['to'];
            $query->select('obas.*','oba_details.*',
            DB::raw('(Case When oba_details.start_date between "'.$from.'" and "'.$to.'" THEN "yes" ELSE "no" END) as start_status'),
            DB::raw('(Case When oba_details.complete_date between "'.$from.'" and "'.$to.'" THEN "yes" ELSE "no" END) as complete_status'),
            DB::raw('(Case When oba_details.inuse_date between "'.$from.'" and "'.$to.'" THEN "yes" ELSE "no" END) as inuse_status'));
        }
        
     
    }
        $obas= $query->get()->groupBy(['project_id','oba_types_id']);
        $totalData=$query1->select('obas.project_id',DB::raw('count(obas.project_id) as project_count'))->groupBy('obas.project_id')->get();
        $dataList=['obas'=>$obas,'target'=>$totalData];
         
        return $dataList;
    }


    
  
}
