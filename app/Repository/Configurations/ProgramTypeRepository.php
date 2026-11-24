<?php
/**
 * Created by PhpStorm.
 * User: ym
 * Date: 3/26/18
 * Time: 11:29 AM
 */

namespace App\Repository\Configurations;


use App\Models\ProgramTypes;

class ProgramTypeRepository
{
    /**
     * @var program_types
     */
    private $program_types;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(ProgramTypes $program_types)
    {

        $this->program_types = $program_types;
    }

    public function all()
    {
        $result = $this->program_types->orderBy('id','desc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->program_types->find($id);
        return $result;
    }
   
}