<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\StructureRequest;
use App\Models\Structures;
use App\Repository\Configurations\StructureRepository;
use App\Repository\Configurations\UnitsRepository;
use Illuminate\Http\Request;

class StructureController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $structureRepository;
    private $unitsRepository;

     public function __construct(StructureRepository $structureRepository, UnitsRepository $unitsRepository){

         parent::__construct();
         $this->structureRepository=$structureRepository;
         $this->unitsRepository=$unitsRepository;
         
     }
    public function index(Request $request)
    {
        $structures= $this->structureRepository->all();
        return view('backend.configurations.structure.index',compact('structures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $structure= $this->structureRepository->getParent();
        $structureList= $structure->groupBy('sector_name');
        $unitsList= $this->unitsRepository->all();
        return view('backend.configurations.structure.add',compact('structureList','unitsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StructureRequest $request)
    {
         try {
             $structureDetails=$request->all();
             if(isset($structureDetails['parent_id']) && $structureDetails['parent_id']==null){
                 $structureDetails['parent_id']=0;
             }
            $create = Structures::create($structureDetails);
            if ($create) {
                session()->flash('success', 'Structures successfully created!');
                return redirect(route('structure.index'));
            } else {
                session()->flash('error', 'Structures could not be created!');
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
            $edits = $this->structureRepository->findById($id);
            if ($edits->count() > 0) {
                
               $structure= $this->structureRepository->getParent();
               $structureList= $structure->groupBy('sector_name');

                $unitsList= $this->unitsRepository->all();
                return view('backend.configurations.structure.edit', compact('edits','structureList','unitsList'));
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
    public function update(StructureRequest $request, $id)
    {
          $id = (int)$id;
        try {
            $structureList= $request->all();
            $structures = $this->structureRepository->findById($id);
            if(isset($structureDetails['parent_id']) && $structureList['parent_id']==null){
                $structureList['parent_id']=0;
            }
            if ($structures) {
                $structures->fill($structureList)->save();
                session()->flash('success', 'Structures updated successfully!');

                return redirect(route('structure.index'));
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
        $id= (int)$id;
        try{
            $value= $this->structureRepository->findById($id);
            $value->delete();
            session()->flash('success','Structure Successfully deleted!');
            return back();

        }catch(\Exception $e){
               session()->flash('error','EXCEPTION:'.$e->getMessage());
               return back();
        }
    }
}
