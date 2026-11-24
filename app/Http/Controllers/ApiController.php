<?php

namespace App\Http\Controllers;

use App\Models\ProgressData;
use App\Models\Projects;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $projects;
    private $progressData;

    public function __construct( Projects $projects,ProgressData $progressData)
    {
        $this->projects = $projects;
        $this->progressData = $progressData;
    }
    public function getProjectData(){

        $recent_month=Carbon::today()->subMonths(1)->month;
        $year=Carbon::today()->subMonths(1)->year;
        $projects=$this->projects->select('id','name')->get();
        $progressData=$this->progressData->select('project_id','target','progress')->where('year',$year)->where('month_code',$recent_month)->orderBy('id', 'asc')->get()->groupBy('project_id');
        foreach ($projects as $key => $project) {
            $project['target']='';
            $project['progress']='';
            $project['status']='';
            if(isset($progressData[$project->id])){
                foreach ($progressData[$project->id] as $key1 => $value) {
                    $project['target']=$value->target;
                    $project['progress']=$value->progress;
                    $project['status']=null;
                    if($value->target!=null ){
                        if($value->target>$value->progress){

                             $project['status']='Behind Target';
                        }else{
                           $project['status']='On Target';
           
                        }
                    }
                }
            }
        }
        return response()->json($projects);
    }
}
