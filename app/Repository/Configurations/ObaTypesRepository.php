<?php


namespace App\Repository\Configurations;


use App\Models\ObaTypes;

class ObaTypesRepository
{
    /**
     * @var program_types
     */
    private $oba_types;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(ObaTypes $oba_types)
    {

        $this->oba_types = $oba_types;
    }

    public function all()
    {
        $result = $this->oba_types->orderBy('id','desc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->oba_types->find($id);
        return $result;
    }
}