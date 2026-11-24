<?php
/**
 * Created by PhpStorm.
 * User: ym
 * Date: 3/26/18
 * Time: 11:29 AM
 */

namespace App\Repository\Configurations;


use App\Models\ProjectRegions;

class ProjectRegionRepository
{
    /**
     * @var project_region
     */
    private $project_region;

    /**
     * ProgramTypeRepository constructor.
     */
    public function __construct(ProjectRegions $project_region)
    {

        $this->project_region = $project_region;
    }

    public function all()
    {
        $result = $this->project_region->orderBy('id','desc')->get();
        return $result;
    }
    
}