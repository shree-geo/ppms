<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\TestTypeRequest;
use Illuminate\Http\Request;
use App\Models\TestType;
use App\Repository\Configurations\MaterialRepository;
use App\Repository\Configurations\TestTypeRepository;

class TestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $testTypeRepository;
    private $materialRepository;

    public function __construct(TestTypeRepository $testTypeRepository, MaterialRepository $materialRepository)
    {
        // parent::__construct();
        $this->testTypeRepository = $testTypeRepository;
        $this->materialRepository = $materialRepository;
    }

    public function index(Request $request)
    {
        $testTypes = $this->testTypeRepository->all();
        $materials = $this->materialRepository->all();

        return view('backend.configurations.testType.index', compact('testTypes','materials'));
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
    public function store(TestTypeRequest $request)
    {
        try {
            $create = TestType::create($request->all());
            if ($create) {
                session()->flash('success', 'Test Types successfully created!');
                return back();
            } else {
                session()->flash('error', 'Test Types could not be created!');
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
            $edits = $this->testTypeRepository->findById($id);
            if ($edits->count() > 0) {
                $testTypes = $this->testTypeRepository->all();
                 $materials = $this->materialRepository->all();

                return view('backend.configurations.testType.index', compact('edits', 'testTypes','materials'));
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
    public function update(TestTypeRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $testTypes = $this->testTypeRepository->findById($id);
            if ($testTypes) {
                $testTypes->fill($request->all())->save();
                session()->flash('success', 'Test Types updated successfully!');

                return redirect(route('test_type.index'));
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
            $value = $this->testTypeRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Test Types successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
