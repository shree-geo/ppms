<?php


namespace App\Repository\Configurations;


use App\Models\Units;

class UnitsRepository
{
    /**
     * @var Units
     */
    private $units;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(Units $units)
    {

        $this->units = $units;
    }

    public function all()
    {
        $result = $this->units->orderBy('id', 'asc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->units->find($id);
        return $result;
    }
}
