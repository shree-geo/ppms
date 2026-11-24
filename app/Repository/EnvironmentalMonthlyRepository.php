<?php

namespace App\Repository;

use App\Models\EnvironmentalMonthly;


class EnvironmentalMonthlyRepository
{

    /**
     * @var EnvironmentalMonthly
     */
    private $env_monthly;

    public function __construct(EnvironmentalMonthly $env_monthly)
    {
        $this->env_monthly = $env_monthly;
    }

    public function getByGroupNameEmp(){
        $data= $this->env_monthly->where('group_name','ssEmp')->get();
        return $data;
    }
    public function getByGroupNameEnvironmental(){
        $data= $this->env_monthly->where('group_name','environmental')->get();
        return $data;
    }
    public function getByGroupNameRisk(){
        $data= $this->env_monthly->where('group_name','risk')->get();
        return $data;
    }
  
    public function getByGroupNameSafety(){
        $data= $this->env_monthly->where('group_name','safety')->get();
        return $data;
    }
    public function getByGroupNameCommunity(){
        $data= $this->env_monthly->where('group_name','community')->get();
        return $data;
    }
    public function getByGroupNameIssues(){
        $data= $this->env_monthly->where('group_name','issues')->get();
        return $data;
    }
    public function getByGroupNameSafeguard(){
        $data= $this->env_monthly->where('group_name','socialSafeguard')->get();
        return $data;
    }
    public function getGroupName()
    {
        $data=$this->env_monthly->get();
        return $data->groupBy('group_name');
    }
  
}
