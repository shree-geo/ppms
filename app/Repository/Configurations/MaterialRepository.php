<?php


namespace App\Repository\Configurations;


use  App\Models\Materials;

class MaterialRepository
{
    /**
     * @var Materials
     */
    private $materials;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(Materials $materials)
    {

        $this->materials = $materials;
    }

    public function all()
    {
        $result = $this->materials->orderBy('id', 'asc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->materials->find($id);
        return $result;
    }
}
