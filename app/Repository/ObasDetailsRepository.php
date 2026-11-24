<?php

namespace App\Repository;

use App\Models\ObaDetails;

class ObasDetailsRepository
{

    /**
     * @var ObaDetails
     */
    private $obas_details;

    public function __construct(ObaDetails $obas_details)
    {
        $this->obas_details = $obas_details;
    }
    public function all()
    {
        $result = $this->obas_details->orderBy('id','desc')->get();
        return $result;

    }
    public function findById($id)
    {
        $result = $this->obas_details->where('id', $id)->first();
        return $result;
    }

    public function findByObasId($id){
        $result= $this->obas_details->where('obas_id',$id)->get();
        return $result;
    }

}