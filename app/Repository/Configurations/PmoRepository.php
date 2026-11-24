<?php

namespace App\Repository\Configurations;

use App\Models\Configurations\Pmo;

class PmoRepository
{

    /**
     * @var Pmo
     */
    private $pmo;

    public function __construct(Pmo $pmo)
    {
        $this->pmo = $pmo;
    }

    public function all()
    {
        $pmo = $this->pmo->first();
        return $pmo;
    }
    public function findById($id)
    {
        $pmo = $this->pmo->find($id);
        return $pmo;
    }

}
