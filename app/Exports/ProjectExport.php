<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProjectExport implements FromView, ShouldAutoSize
{
    
    private $data;
    private $module_name;
    private $list;

    public function __construct($data,$module_name,$list=null)
    {
        $this->data=$data;
        $this->module_name=$module_name;
        $this->list=$list;
    }
    public function view(): View
    {
       
           if($this->module_name=='project'){

            return view('export.project',['projects'=>$this->data]);
           }elseif($this->module_name=='worker'){
               $workers= $this->data;
               $list= $this->list;
            return view('export.worker',compact('workers','list'));

           } elseif($this->module_name=='program'){
            return view('export.program',['programs'=>$this->data]);

           } elseif($this->module_name=='issues'){
            return view('export.issue',['issues'=>$this->data]);

           } elseif($this->module_name=='staffs'){
               $staffs=$this->data;
               $list=$this->list;
               return view('export.staff',compact('staffs','list'));
               
            } elseif($this->module_name=='workmanship'){
             return view('export.workmanship',['projects'=>$this->data]);
 
            } elseif($this->module_name=='programsReport'){
             return view('reports.export.program',['programs'=>$this->data]);
 
            } elseif($this->module_name=='qctestsReport'){
                $qc_tests=$this->data;
                $months=$this->list;
             return view('reports.export.qc_type',compact('qc_tests','months'));
 
            } elseif($this->module_name=='workerReport'){
                $workers=$this->data;
                $months=$this->list;
             return view('reports.export.worker',compact('workers','months'));
 
            } elseif($this->module_name=='obaReport'){
                $obas=$this->data;
                $list=$this->list;
             return view('reports.export.exportOba',compact('obas','list'));
 
            }elseif($this->module_name=='environment'){
             return view('export.environment',['environments'=>$this->data]);
 
            }elseif($this->module_name=='beneficary'){
              $beneficary=$this->data;
              return view('export.beneficary',compact('beneficary'));

           } elseif($this->module_name=='institutions'){
            $institutions=$this->data;
            return view('export.institutions',compact('institutions'));

           } elseif($this->module_name=='obas'){
            $obas=$this->data;
            $list = $this->list;
            return view('export.obas',compact('obas','list'));

        } elseif($this->module_name=='members'){
            $members=$this->data;
            return view('export.members',compact('members'));

        } elseif($this->module_name=='monitorings'){
            $monitorings=$this->data;
            return view('export.monitorings',compact('monitorings'));

        }   elseif($this->module_name=='safeguards'){
            $safeguards=$this->data;
            return view('export.safeguards',compact('safeguards'));

        }  elseif($this->module_name=='qualitycontrol'){
            $qualitycontrol=$this->data;
            return view('export.qualitycontrol',compact('qualitycontrol'));
        }
         elseif($this->module_name=='qualitycontroltest'){
            $qualitycontroltest=$this->data;
            $list = $this->list;
            return view('export.qualitycontroltest',compact('qualitycontroltest','list'));
        }  elseif($this->module_name=='grievances'){
                $grievances=$this->data;
                return view('export.grievances',compact('grievances'));
        } elseif($this->module_name=='safeguardindicators'){
                $safeguardindicators=$this->data;
                return view('export.safeguardindicators',compact('safeguardindicators'));
            }
         elseif($this->module_name=='monthly_progress'){
                $progress_data=$this->data;
                return view('reports.export.monthly_progress',compact('progress_data'));
            }
         elseif($this->module_name=='memberReport'){
                $temp=$this->data;
            $data = $this->list;

                return view('reports.export.member',compact('temp','data'));
            }
            
   
    
    }
  
    
}
