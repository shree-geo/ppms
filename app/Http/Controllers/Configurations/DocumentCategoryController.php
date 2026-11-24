<?php

namespace App\Http\Controllers\Configurations;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\DocumentCategoryRequest;
use App\Models\DocumentCatgories;
use App\Repository\Configurations\DocumentCategoryRepository;


class DocumentCategoryController extends BaseController
{

    private $documentCategoryRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DocumentCategoryRepository $documentCategoryRepository)
    {
        parent::__construct();
        $this->documentCategoryRepository = $documentCategoryRepository;
    }

    public function index()
    {
        $categories = $this->documentCategoryRepository->all();
        return view('backend.configurations.document_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentCategoryRequest $request)
    {
        try {
            $create = DocumentCatgories::create($request->all());
            if ($create) {
                session()->flash('success', 'Document Category successfully created!');
                return back();
            } else {
                session()->flash('error', 'Document Category could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits = $this->documentCategoryRepository->findById($id);
            if ($edits->count() > 0) {
                $categories = DocumentCatgories::get();
                return view('backend.configurations.document_category.index', compact('edits', 'categories'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentCategoryRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $documentCategory = $this->documentCategoryRepository->findById($id);

            if ($documentCategory) {
                $documentCategory->fill($request->all())->save();
                session()->flash('success', 'Document category updated successfully!');

                return redirect(route('document_category.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->documentCategoryRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Document Category successfully deleted!');
            return back();
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();
        }
    }

  
}
