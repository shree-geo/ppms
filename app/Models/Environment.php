<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
   protected $fillable=['project_id','gon_tor_approval','gon_tor_approval_date','gon_approval_iee','gon_approval_iee_date',
                          'adb_report_disclosed','adb_report_disclosed_date','adb_final_approval','adb_final_approval_date',
                          'emp_ssemp_prepared','focal_person','safe_statutory_clearance','safe_envi_clearance','safe_site_clearance','safe_tree_cutting',
                          'safe_no_objection','safe_construct_permit','safe_operate_permit','safe_road_cutting_permit','safe_utility_shifting_permit'
                        ,'safe_covid_reponse','safe_mou','safe_mou_file','gon_tor_approval_file','gon_iee_file','adb_approval_file'];


     public function project(){
         return $this->belongsTo('App\Models\Projects');
     }                     
}
