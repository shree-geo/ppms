<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheet implements WithMultipleSheets
{
    
    use Exportable;

    private $data;
    private $group_name;
    private $month_list;

    public function __construct($data, $group_name,$month_list)
    {
        $this->data=$data;
        $this->group_name=$group_name;
        $this->month_list=$month_list;
    }
    public function sheets():array
    {
        $sheets=[];
        foreach($this->group_name as $key=>$value){
            if($key=='ssEmp'){
                $sheetName='SafeGuard';
            }elseif($key=='environmental'){
                $sheetName='Environmental';
            }elseif($key=='risk'){
                $sheetName='Risk Assessment';
            }elseif($key=='safety'){
                $sheetName='Safety Facilities';
            }elseif($key=='community'){
                $sheetName='Community Safety';
            }elseif($key=='issues'){
                $sheetName='Issues and Corrective Actions';
            }elseif($key=='socialSafeguard'){
                $sheetName='Safety and Health Facility';
            }
            $sheets[]=new EnvironmentalExport($this->data,'environments_monthly',$value,$this->month_list,$sheetName);
        }
        return $sheets;

    }
}
