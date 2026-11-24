<?php

namespace App\Repository;

use App\Models\BaseLines;

class BaseLineRepository
{

    /**
     * @var BaseLine
     */
    private $base_lines;

    public function __construct(BaseLines $base_lines)
    {
        $this->base_lines = $base_lines;
    }
    public function all()
    {
        $result = $this->base_lines->orderBy('id','desc')->get();
        return $result;

    }

    public function findByProjectId($p_id,$type){
        $result= $this->base_lines->where('project_id',$p_id)->where('base_line_type',$type)->first();
        return $result;
    }

    public function getDataByType(){
        $data= $this->base_lines->all();
        return $data->groupBy('base_line_type');
    }

}