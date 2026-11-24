<?php


namespace App\Repository\Configurations;


use App\Models\Structures;

class StructureRepository
{
    /**
     * @var Structure
     */
    private $structure;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(Structures $structure)
    {

        $this->structure = $structure;
    }

    public function all()
    {
        $result = $this->structure->orderBy('id', 'asc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->structure->find($id);
        return $result;
    }
    public function getParent(){
        $result= $this->structure->where('parent_id',0)->get();
        return $result;
    }

    public function parentList($sector){
        $result= $this->structure->where('parent_id',0)->where('sector_name',$sector)->orderBy('id','asc')->get();
        $parentColl=[];
        foreach($result as $data){
            $childs= $this->getChild($data->id);
            if(count($childs)>0){
                $data['child']=$childs;
            }
            array_push($parentColl,$data);
        }
        return $parentColl;
    }

    public function getChild($parent_id){
        $child= $this->structure->where('parent_id',$parent_id)->get();
        return $child;

    }

    public function getstructureName()
    {
       $result=$this->structure->get()->groupBy('sector_name');
       return $result;
    }

}
