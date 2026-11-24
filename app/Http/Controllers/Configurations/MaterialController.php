<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use App\Http\Requests\Configurations\MaterialRequest;
use App\Models\Materials;
use App\Repository\Configurations\MaterialRepository;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        parent::__construct();
        $this->materialRepository = $materialRepository;
    }

    public function index(Request $request)
    {
        $materials = $this->materialRepository->all();
        return view('backend.configurations.material.index', compact('materials'));
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
    public function store(MaterialRequest $request)
    {
        try {
            $create = Materials::create($request->all());
            if ($create) {
                session()->flash('success', 'Materials successfully created!');
                return back();
            } else {
                session()->flash('error', 'Materials could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Exception : ' . $e->getMessage());
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
            $edits = $this->materialRepository->findById($id);
            if ($edits->count() > 0) {
                $materials = $this->materialRepository->all();
                return view('backend.configurations.material.index', compact('edits', 'materials'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION :' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $materials = $this->materialRepository->findById($id);
            if ($materials) {
                $materials->fill($request->all())->save();
                session()->flash('success', 'Materials updated successfully!');

                return redirect(route('material.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION:' . $e->getMessage());
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
            $value = $this->materialRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Materials successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
