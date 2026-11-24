<?php
namespace App\Repository\Configurations;


use App\Models\DocumentCatgories;

class DocumentCategoryRepository
{
    /**
     * @var DocumentCategories
     */
    private $documentCategory;

    /**
     * CountryRepository constructor.
     */
    public function __construct(DocumentCatgories $documentCategory)
    {

        $this->documentCategory = $documentCategory;
    }

    public function all()
    {
        $result = $this->documentCategory->orderBy('id','desc')->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->documentCategory->find($id);
        return $result;
    }
}