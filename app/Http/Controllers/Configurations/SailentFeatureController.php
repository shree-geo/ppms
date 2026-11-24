<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Models\Configurations\SalientFeature;
use App\Repository\Configurations\FeatureRepository;
use Illuminate\Http\Request;

class SailentFeatureController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $featureRepository;

     public function __construct(FeatureRepository $featureRepository){

         parent::__construct();
         $this->featureRepository=$featureRepository;
         
     }
    public function index(Request $request)
    {
        $features= $this->featureRepository->all();
        return view('backend.configurations.feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
             $featureDetails=$request->all();
          
            $create = SalientFeature::create($featureDetails);
            if ($create) {
                session()->flash('success', 'Features successfully created!');
                return back();
            } else {
                session()->flash('error', 'Features could not be created!');
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
            $edits = $this->featureRepository->findById($id);
            if ($edits->count() > 0) {

             $features= $this->featureRepository->all();
               
                return view('backend.configurations.feature.index', compact('edits','features'));
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
    public function update(Request $request, $id)
    {
          $id = (int)$id;
        try {
            $featureList= $request->all();
            $featureData = $this->featureRepository->findById($id);
          
            if ($featureData) {
                $featureData->fill($featureList)->save();
                session()->flash('success', 'Features updated successfully!');

                return redirect(route('sailent_feature.index'));
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
            $value= $this->featureRepository->findById($id);
            $value->delete();
            session()->flash('success','Feature Successfully deleted!');
            return back();

        }catch(\Exception $e){
               session()->flash('error','EXCEPTION:'.$e->getMessage());
               return back();
        }
    }
}
