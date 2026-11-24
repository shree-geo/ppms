<?php

namespace App\Repository;

use App\Models\LoanStatus;
use App\Models\Projects;


class LoanStatusRepository
{

    /**
     * @var LoanStatus
     */
    private $loanStatus;
    private $project;

    public function __construct(LoanStatus $loanStatus, Projects $project)
    {
        $this->loanStatus = $loanStatus;
        $this->project = $project;
    }
    public function all()
    {
        $group_id = auth()->user()->user_group_id;
        $results = [];
        if ($group_id == 2) {
            $project_id = auth()->user()->project_id;
            $data = $this->loanStatus->where('project_id', $project_id)->orderBy('id', 'desc')->get();
            $temp = $data->groupBy('project_id');
            array_push($results, $temp);
        } elseif ($group_id == 3) {
            $region_id = auth()->user()->region_id;
            $projects = $this->project->where('region_id', $region_id)->get();
            foreach ($projects as $project) {
                $data = $this->loanStatus->where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                    $temp = $data->groupBy('project_id');
                    array_push($results, $temp);
                }
            }
        } else {
            $data = $this->loanStatus->orderBy('id', 'desc')->get();
            $temp = $data->groupBy('project_id');
            array_push($results, $temp);
        }
        return $results;
    }

    public function findById($id)
    {
        $group_id = auth()->user()->user_group_id;
        $result = $this->loanStatus->find($id);
        $projects = $this->project->where('id', $result->project_id)->first();

        if (($group_id == 2 && auth()->user()->project_id == $result->project_id) || ($group_id == 3 and auth()->user()->region_id == $projects->region_id) || ($group_id == 1)) {
            return $result;
        } else {
            $result = null;
            return $result;
        }
    }

    public function getByProjectId($proj_id, $search = null)
    {
        $result = [];
        $data = $this->loanStatus->where('project_id', $proj_id)->orderBy('id', 'desc')->get();
        if ($search != null) {
            $temp = $data->groupBy('project_id');
            array_push($result, $temp);
            return $result;
        } else {
            return $data;
        }
    }

}