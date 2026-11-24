<?php


namespace App\Repository\Configurations;


use App\Models\ProjectType;

class ProjecTypeRepository
{
    /**
     * @var ProjectType
     */
    private $projectType;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(ProjectType $projectType)
    {

        $this->projectType = $projectType;
    }

    public function all()
    {
        $result = $this->projectType->orderBy('id', 'asc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->projectType->find($id);
        return $result;
    }
    public function findByProjectId($id){
        $result= $this->projectType->where('project_id',$id)->get();
        return $result;
    }
    public function getTypeBySector($sector_name)
    {
        $data = $this->projectType->where('project_sector',$sector_name)->get();
        return $data;
    }

    public function getTypeBySectorName()
    {
        $data = $this->projectType->get();
        return $data->groupBy('project_sector');
    }
    public function getByProjectType($proj_type_id){
        $result= $this->projectType->where('id',$proj_type_id)->get();
        return $result;
    }

    public function getBySectorName($sector_name){
        $data= $this->projectType->where('project_sector', $sector_name)->get();
        return $data;
    }
}
