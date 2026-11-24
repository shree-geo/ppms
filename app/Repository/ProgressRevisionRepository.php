<?php
namespace App\Repository;

use App\Revision;

class ProgressRevisionRepository
{
    /**
     * @var Revision
     */
    private $revision;

    /**
     * ProgressRevisionRepository constructor.
     */
    public function __construct(Revision $revision)
    {

        $this->revision = $revision;
    }

    public function all()
    {
        $result = $this->revision->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->revision->find($id);
        return $result;
    }
}