<?php

namespace App\Http\Controllers;

use App\Exports\DetailsExport;
use App\Exports\ProjectExport;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use App\Repository\ObaRepository;
use App\Repository\ObasDetailsRepository;
use App\Repository\Configurations\ObaTypesRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Http\Requests\ObasRequest;
use App\Models\Oba;
use App\Models\ObaDetails;
use App\Models\ObaLogs;
use App\Repository\Configurations\DistrictRepository;
use App\Repository\Configurations\DataRepository;
use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use App\Imports\ObasImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class ObaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $projectRepository;
    private $obasRepository;
    private $obaTypesRepository;
    private $districtRepository;
    private $fiscalYearRepository;
    private $dataRepository;
    private $obasDetailsRepository;


    public function __construct(
        ProjectRepository $projectRepository,
        ObaRepository $obasRepository,
        ObaTypesRepository $obaTypesRepository,
        DistrictRepository $districtRepository,
        FiscalYearRepository $fiscalYearRepository,
        DataRepository $dataRepository, ObasDetailsRepository $obasDetailsRepository

    ) {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->obasRepository = $obasRepository;
        $this->obaTypesRepository = $obaTypesRepository;
        $this->districtRepository = $districtRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->dataRepository = $dataRepository;
        $this->obasDetailsRepository = $obasDetailsRepository;
    }

    public function index(Request $request)
    {
        if ($request->project_id != null ||$request->oba_types_id!=null|| $request->from!=null || $request->to!=null) {
            $result = $this->obasRepository->searchData($request->all());
            $obas= $result->groupBy('project_id');
        } else {
            $obas = $this->obasRepository->all();
        }
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->englishMonths();
        $oba_types = $this->obaTypesRepository->all();
          $list['monthslist'] =$monthList; 
           $list['castlist']  =$this->dataRepository->casts(); 
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
                $filename='obas'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();
                return Excel::download(new ProjectExport($obas,'obas',$list),$filename);
        }else{
            return view('project.obas.index', compact('obas', 'projects','monthList','oba_types'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $oba_types = $this->obaTypesRepository->all();
        $projects = $this->projectRepository->all();
        $districts = $this->districtRepository->all();
        $year = $this->fiscalYearRepository->all();
        $month = $this->dataRepository->englishMonths();
        $casts=$this->dataRepository->casts();
        $oba_status['toilet_facility']=['started'=>'Started','not_started'=>'Not Started','completed'=>'Completed','inuse'=>'Inuse'];
        $oba_status['water_facility']=['connected'=>'Connected','not_connected'=>'Not Connected'];
        return view('project.obas.add', compact('oba_types', 'projects', 'districts', 'year', 'month','casts','oba_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObasRequest $request)
    {
        try {
           
            $obasDetails = $request->obas;
           $ownerdetails= $request->details;

            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $obasDetails['project_id'] = auth()->user()->project_id;
            }
            $obasDetails['status']='submitted';
            $obasDetails['status_date']=Carbon::now();
            DB::beginTransaction();
            $create = Oba::create($obasDetails)->id;
            $obasLogs['user_id']=auth()->user()->id;
            $obasLogs['status']=$obasDetails['status'];
            $obasLogs['status_date']=$obasDetails['status_date'];
            foreach($ownerdetails as $details){
                $details['obas_id']=$create;
                 if(!isset($details['househead_women'])) {

                    $details['househead_women']=0;
                 }
                 if($details['oba_status']==null && $obasDetails['oba_types_id']==1){
                     $details['oba_status']='not_started';
                 }
                 elseif($details['oba_status']==null && $obasDetails['oba_types_id']==2){
                     $details['oba_status']='not_connected';
                 }
                 if($details['oba_status']=='started'||$details['oba_status']=='connected'){
                    $details['start_date']=$details['date'];
                 }
                 elseif($details['oba_status']=='completed'){
                    $details['complete_date']=$details['date'];
                 }
                 elseif($details['oba_status']=='inuse'){
                    $details['inuse_date']=$details['date'];
                 }

                ObaDetails::create($details);
            }
            if ($create) {
                $obasLogs['oba_id']=$create;
                ObaLogs::create($obasLogs);
                DB::commit();
                session()->flash('success', 'Obas successfully created!');
                return redirect(route('oba.index'));
            } else {
                DB::rollback();
                session()->flash('error', 'Obas could not be created!');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            DB::rollback();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back()->withInput();
        } catch (\DBTransactionException $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'failed'
            ]);
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
            $edits['obas'] = $this->obasRepository->findById($id);
            if ($edits['obas'] != null && $edits['obas']->count() > 0) {
                $projects = $this->projectRepository->all();
                $oba_types = $this->obaTypesRepository->all();
                $districts = $this->districtRepository->all();
                $year = $this->fiscalYearRepository->all();
                $month = $this->dataRepository->englishMonths();
                $edits['details']= $this->obasDetailsRepository->findByObasId($id);
               $casts=$this->dataRepository->casts();
               $oba_status['toilet_facility']=['started'=>'Started','not_started'=>'Not Started','completed'=>'Completed','inuse'=>'Inuse'];
               $oba_status['water_facility']=['connected'=>'Connected','not_connected'=>'Not Connected'];
              

                return view('project.obas.edit', compact('edits', 'projects', 'oba_types', 'districts', 'year', 'month','casts','oba_status'));
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
    public function update(ObasRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $obasDetails = $request->obas;
           $ownerdetails= $request->details;
           DB::beginTransaction();
                foreach ($ownerdetails as $key => $value) {
                    $value['obas_id'] = $id;
                    if(!isset($value['househead_women'])) {

                    $value['househead_women']=0;
                 }
                 if($value['oba_status']==null && $obasDetails['oba_types_id']==1){
                    $value['oba_status']='not_started';
                }
                elseif($value['oba_status']==null && $obasDetails['oba_types_id']==2){
                    $value['oba_status']='not_connected';
                }
                if($value['oba_status']=='started' || $value['oba_status']=='connected'){
                   $value['start_date']=$value['date'];
                }
                elseif($value['oba_status']=='completed'){
                   $value['complete_date']=$value['date'];
                }
                elseif($value['oba_status']=='inuse'){
                   $value['inuse_date']=$value['date'];
                }

                if(isset($value['oba_index_id'])){
                    $data=$this->obasDetailsRepository->findById($value['oba_index_id']);
                    $data->fill($value)->save();
                }else{
                 ObaDetails::create($value);
                 }
                }

            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $obasDetails['project_id'] = auth()->user()->project_id;
            }
            $obas = $this->obasRepository->findById($id);
            if ($obas) {
                $obas->fill($obasDetails)->save();
                DB::commit();
                session()->flash('success', 'Obas updated successfully!');

                return redirect(route('oba.index'));
            } else {
                DB::rollback();
                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            DB::rollback();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back()->withInput();
        } catch (\DBTransactionException $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'failed'
            ]);
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
            $value = $this->obasRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Obas successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

     public function updateStatus(Request $request){
      try {
           $details= $request->all();
           $details['user_id']=auth()->user()->id;
           $details['status_date']=Carbon::now();
           if($details['status']!=null){
            $value = $this->obasRepository->findById($details['oba_id']);
            $value->fill($details)->save();
            ObaLogs::create($details);
                return back();
           }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function importObaData()
    {
        // dd('ff');
        $projects= $this->projectRepository->all();
        $oba_types= $this->obaTypesRepository->all();
        $districts = $this->districtRepository->all();
        $year = $this->fiscalYearRepository->all();
        $month = $this->dataRepository->englishMonths();

         return view('reports.import.obas',compact('projects','oba_types','districts','year','month'));
        
    }

    public function importExcel(Request $request)

    {
        try{
            $obasDetails = $request->all();
            DB::beginTransaction();
             $user_group = auth()->user()->user_group_id;
             if ($user_group == 2) {
                 $obasDetails['project_id'] = auth()->user()->project_id;
             }
             $obasDetails['status']='submitted';
             $obasDetails['remarks']='';
             $obasDetails['status_date']=Carbon::now();
             $create=Oba::create($obasDetails);
            if($request->file('file')){
                $import =  Excel::import(new ObasImport($create->id), request()->file('file'));
    
                if ($import) {
                DB::commit();

                    session()->flash('success', 'Data Uploaded Succesfully!');

                    return redirect(route('oba.index'));
    
                }else{
            DB::rollback();

                   return back()->with('danger', 'Data Uploaded failed!');
    
                }
    
            }
        }catch (\Exception $e) {
            DB::rollback();

            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();

        }


    }
}
