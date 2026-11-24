<?php


namespace App\Repository\Configurations;


use App\Models\Configurations\SalientFeature;

class FeatureRepository
{
    /**
     * @var SalientFeature
     */
    private $feature;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(SalientFeature $feature)
    {

        $this->feature = $feature;
    }

    public function all()
    {
        $result = $this->feature->orderBy('id', 'desc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->feature->find($id);
        return $result;
    }

    public function getBySector($sector){
        $result= $this->feature->where('sector_name',$sector)->get();
        return $result;
    }

   
 

}
