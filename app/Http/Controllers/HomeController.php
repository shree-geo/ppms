<?php

namespace App\Http\Controllers;

use App\Repository\ProgressDataRepository;
use App\Repository\Roles\MenuRepository;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use CommonHelper;
use Carbon\Carbon;
use Session;


class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * @var MenuRepository
     */
    private $menuRepository;
    private $projectRepository;
    private $progressDataRepository;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MenuRepository $menuRepository, ProjectRepository $projectRepository, ProgressDataRepository $progressDataRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->projectRepository = $projectRepository;
        $this->progressDataRepository = $progressDataRepository;
    }

    public function index()
    { 
        $month_name=Carbon::today()->subMonths(1)->englishMonth;
        $year=Carbon::today()->subMonths(1)->year;
        $recent_month=Carbon::today()->subMonths(1)->month;
        Session::put('month_name',$month_name);
        Session::put('year',$year);
        $memberStatus=checkMemberStatus();
        $projectsDetail=$this->projectRepository->all();
        $projects=$projectsDetail->mapWithKeys(function ($item) {
               return [$item['id'] => $item['name']];
        });
        $colors=[
            'Comply'=>'primary',
            'WUSC doesnot contain 9 member'=>'danger',
            'WUSC doesnot contain 3 female members'=>'purple',
            'WUSC doesnot contain 1 female at key position'=>'warning',
        ];
       
        $progressData= $this->progressDataRepository->getRecentMonthData($recent_month,$year);
        foreach ($progressData as $key => $progress) {
            foreach ($progress as $key => $value) {
                if($value->target!=null ){

                    if($value->target>$value->progress){
                         $value['status']='Behind Target';
                    }else{
                       $value['status']='On Target';
       
                    }
                }
            }
        }
        $cumulativeProgress=$this->progressDataRepository->findFinancialProgressData();
        foreach ($cumulativeProgress as $key => $progress) {
            foreach ($progress as $key => $value) {
                if($value->target_total!=null ){

                    if($value->target_total>$value->progress_total){
                         $value['status']='Behind Target';
                    }else{
                       $value['status']='Complete';
       
                    }
                }
                if($value->target_total==null){
                    $value->target_total=0;

                }   if($value->progress_total==null){
                    $value->progress_total=0;

                }
            }
        }
        return view('backend.dashboard',compact('memberStatus','projects','colors','progressData','year','month_name','cumulativeProgress'));
    }
}
