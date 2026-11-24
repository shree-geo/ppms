<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;

class EnvironmentalExport implements FromView, ShouldAutoSize,WithTitle
{
    
    private $data;
    private $module_name;
    private $group_name;
    private $date_details;
    private $sheetName;

    public function __construct($data,$module_name,$group_name=null,$date_details=null,$sheetName=null)
    {
        $this->data=$data;
        $this->module_name=$module_name;
        $this->group_name=$group_name;
        $this->date_details=$date_details;
        $this->sheetName=$sheetName;
    }
    public function view(): View
    {
             
     return view('export.environmentsMonthly',['environments_monthly' =>$this->data,'group_detail'=> $this->group_name,'date_details'=>$this->date_details,'sheetName'=>$this->sheetName]);
    
    
    }
     public function title(): string
    {
        return $this->sheetName;
    }
  
    
}
