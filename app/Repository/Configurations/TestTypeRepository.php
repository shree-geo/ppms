<?php


namespace App\Repository\Configurations;


use App\Models\TestType;

class TestTypeRepository
{
    /**
     * @var TestType
     */
    private $test_types;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(TestType $test_types)
    {

        $this->test_types = $test_types;
    }

    public function all()
    {
        $result = $this->test_types->with('materials')->orderBy('id', 'asc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->test_types->with('materials')->find($id);
        return $result;
    }
}
