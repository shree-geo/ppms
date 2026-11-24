<?php

namespace App\Repository;

use App\Models\Documents;
use App\Models\Projects;


class DocumentRepository
{

    /**
     * @var Documents
     */
    private $documents;
    private $project;

    public function __construct(Documents $documents, Projects $project)
    {
        $this->documents = $documents;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->documents->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            $results = [];
            foreach ($projects as $project) {
                $data = $this->documents->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $results[$project->id] = $data;
                }
            }
        } else {
            $data = $this->documents->orderBy('id', 'desc')->get();
            $results = $data->groupBy('project_id');
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->documents->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1) || ($group_id == 4)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id, $search = null)
    {
        $data = $this->documents->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
        if ($search != null) {
            $result = $data->groupBy('project_id');
            return $result;
        } else {
            return $data;
        }
    }

    public function searchData($searchDetails){
        $query=$this->documents->select('documents.*');
        if($searchDetails['project_id']!=null){
            $query->where('project_id',$searchDetails['project_id']);
           
        }
        if($searchDetails['category_id']!=null){
             $query->where('cat_id',$searchDetails['category_id']);
        }
        
        $data=$query->get();
        return $data->groupBy('project_id');
    }

}