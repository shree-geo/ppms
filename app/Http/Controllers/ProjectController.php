<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use Illuminate\Http\Request;
use App\Repository\Configurations\ProjectRegionRepository;
use App\Repository\Configurations\DistrictRepository;
use App\Repository\Configurations\MunicipalityRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\ProjectRepository;
use App\Repository\BaseLineRepository;
use App\Models\Projects;
use App\Models\BaseLines;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\EditprojectRequest;
use App\Models\ProjectDetails;
use App\Models\ProjectDistrict;
use App\Models\ProjectReservoirs;
use App\Models\ProjectSourceDetails;
use App\Repository\BeneficiaryRepository;
use App\Repository\Configurations\PmoRepository;
use App\Repository\InstitutionalRepository;
use App\Repository\ObaRepository;
use App\Repository\ProgramsRepository;
use App\Repository\MemberRepository;
use App\Repository\MonitoringRepository;
use App\Repository\VoRepository;
use App\Repository\EotRepository;
use App\Repository\GrievanceCommitteRepository;
use App\Repository\GrievanceRepository;
use App\Repository\ProjectDetailsRepository;
use App\Repository\ProjectDistrictRepository;
use App\Repository\QCTestRepository;
use App\Repository\SafeguardRepository;
use App\Repository\WorkerRepository;
use App\Repository\ProjectSourceRepository;
use App\Repository\ProjectReservoirRepository;
use App\Repository\Configurations\ProjecTypeRepository;
use DB;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Configurations\StructureController;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\StructureRepository;
use App\Repository\EnvironmentRepository;
use App\Repository\ProjectStructureProgressRepository;
use App\Repository\ProjectStructureRepository;
use App\Repository\SafeGuardIndicatorRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $projectRegionRepository;
    private $districtRepository;
    private $muniRepository;
    private $fyRepository;
    private $projectRepository;
    private $baselineRepository;
    private $beneficiaryRepository;
    private $institutionalRepository;
    private $programsRepository;
    private $obaRepository;
    private $memberRepository;
    private $monitoringRepository;
    private $voRepository;
    private $eotRepository;
    private $projectDistrictRepository;
    private $pmoRepository;
    private $workerRepository;
    private $grievanceRepository;
    private $grievanceCommitteRepository;
    private $qCTestRepository;
    private $safeguardRepository;
    private $projectsourceRepository;
    private $projectreservoirRepository;
    private $projectdetailsRepository;
    private $projecttypeRepository;
    private $dataRepository;
    private $environmentRepository;
    private $projectStructureProgressRepository;
    private $projectStructureRepository;
    private $structureRepository;

    public function __construct(
        ProjectRegionRepository $projectRegionRepository,
        DistrictRepository $districtRepository,
        MunicipalityRepository $muniRepository,
        FiscalYearRepository $fyRepository,
        ProjectRepository $projectRepository,
        BaseLineRepository $baselineRepository,
        BeneficiaryRepository $beneficiaryRepository,
        InstitutionalRepository $institutionalRepository,
        ProgramsRepository $programsRepository,
        ObaRepository $obaRepository,
        MemberRepository $memberRepository,
        MonitoringRepository $monitoringRepository,
        VoRepository $voRepository,
        EotRepository $eotRepository,
        ProjectDistrictRepository $projectDistrictRepository,
        PmoRepository $pmoRepository,
        WorkerRepository $workerRepository,
        GrievanceRepository $grievanceRepository,
        GrievanceCommitteRepository $grievanceCommitteRepository,
        QCTestRepository $qCTestRepository,
        SafeguardRepository $safeguardRepository,
        ProjectSourceRepository  $projectsourceRepository,

        ProjectReservoirRepository $projectreservoirRepository,
        ProjectDetailsRepository $projectdetailsRepository,
        ProjecTypeRepository $projecttypeRepository,
        DataRepository $dataRepository,
        EnvironmentRepository $environmentRepository,
        SafeGuardIndicatorRepository $safeGuardIndicatorRepository,
        ProjectStructureProgressRepository $projectStructureProgressRepository,
        ProjectStructureRepository $projectStructureRepository,
        StructureRepository $structureRepository

    ) {
        Parent::__construct();
        $this->projectRegionRepository = $projectRegionRepository;
        $this->districtRepository = $districtRepository;
        $this->muniRepository = $muniRepository;
        $this->fyRepository = $fyRepository;
        $this->projectRepository = $projectRepository;
        $this->baselineRepository = $baselineRepository;
        $this->beneficiaryRepository = $beneficiaryRepository;
        $this->institutionalRepository = $institutionalRepository;
        $this->programsRepository = $programsRepository;
        $this->obaRepository = $obaRepository;
        $this->memberRepository = $memberRepository;
        $this->monitoringRepository = $monitoringRepository;
        $this->voRepository = $voRepository;
        $this->eotRepository = $eotRepository;
        $this->projectDistrictRepository = $projectDistrictRepository;
        $this->pmoRepository = $pmoRepository;
        $this->workerRepository = $workerRepository;
        $this->grievanceRepository=$grievanceRepository;
        $this->grievanceCommitteRepository=$grievanceCommitteRepository;
        $this->qCTestRepository=$qCTestRepository;
        $this->safeguardRepository=$safeguardRepository;
        $this->projectsourceRepository=$projectsourceRepository;
        $this->projectreservoirRepository=$projectreservoirRepository;
        $this->projectdetailsRepository=$projectdetailsRepository;
        $this->projecttypeRepository=$projecttypeRepository;
        $this->dataRepository=$dataRepository;
        $this->environmentRepository=$environmentRepository;
        $this->safeGuardIndicatorRepository=$safeGuardIndicatorRepository;
        $this->projectStructureProgressRepository=$projectStructureProgressRepository;
        $this->projectStructureRepository=$projectStructureRepository;
        $this->structureRepository=$structureRepository;
    }
    public function index(Request $request)
    {
        $projects = $this->projectRepository->all();
         if($request->has('export')){
                $time=Carbon::now()->toDateTimeString();
                $filename= 'project'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($projects,'project'), $filename);
        }else{
             return view('project.index', compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pmoDetails= $this->pmoRepository->all();
        $project_regions = $this->projectRegionRepository->all();
        $districts = $this->districtRepository->all();
        $municipalities = $this->muniRepository->getMuniByDistrict();
        $fiscal_years = $this->fyRepository->all();
        $projects = $this->projectRepository->all();
        return view('project.add', compact('project_regions', 'districts', 'municipalities', 'fiscal_years', 'projects','pmoDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try {
            DB::beginTransaction();
            $projectDetails = $request->all();
            if(auth()->user()->user_group_id==3){
                $projectDetails['region_id']=auth()->user()->region_id;
            }
            $address = $request->address;
            $projectDetails['latest_eot'] = $projectDetails['completion_date_stage1'];
            $projectDetails['revised_stage2_date'] = $projectDetails['completion_date_stage2'];
            $projectDetails['latest_revised_contract_amount'] = $projectDetails['contract_amount'];
            $projectDetails['latest_revised_cost_estimated'] = $projectDetails['estimated_amount']?$projectDetails['estimated_amount']:0;
            $create = Projects::create($projectDetails)->id;

            DB::select("call progrssData(".$create.")");

            foreach ($address as $key => $value) {
                $value['project_id'] = $create;
                ProjectDistrict::create($value);
            }
            if ($create) {
                DB::commit();
                session()->flash('success', 'Project successfully created!');
                return redirect(route('details.index'));
            } else {
                DB::rollback();
                session()->flash('error', 'Project could not be created!');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Exception' . $e->getMessage());
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
        $project = $this->projectRepository->findById($id);
        $baseline['before'] = $this->baselineRepository->findByProjectId($id, 'before');
        $baseline['after'] = $this->baselineRepository->findByProjectId($id, 'after');
        $beneficiary = $this->beneficiaryRepository->getByProjectId($id);
        $institution = $this->institutionalRepository->getByProjectId($id);
        $programs = $this->programsRepository->getByProjectId($id);
        $obas = $this->obaRepository->getByProjectId($id);
        $members = $this->memberRepository->getByProjectId($id);
        $monitorings = $this->monitoringRepository->getByProjectId($id);
        $vos = $this->voRepository->getByProjectId($id);
        $eots = $this->eotRepository->getByProjectId($id);
        $workerDetails= $this->workerRepository->getByProjectId($id);
        $grievanceDetails=$this->grievanceRepository->getByProjectId($id);
        $grievanceCommitte=$this->grievanceCommitteRepository->getByProjectId($id);
        $qcTestDetails= $this->qCTestRepository->getByProjectId($id);
        $safeguardDetails= $this->safeguardRepository->getByProjectId($id);
        $safeguardIndicatorDetails= $this->safeGuardIndicatorRepository->getByProjectId($id);
        $month=$this->dataRepository->englishMonths();
        $casts=$this->dataRepository->casts();
        $projectsource=$this->projectsourceRepository->findByProjectId($id);
        $projectdetail=$this->projectdetailsRepository->findByProjectId($id);
        $projectreservoir=$this->projectreservoirRepository->findByProjectId($id);
        $environment=$this->environmentRepository->getByProjectId($id);
        $structure_progress=$this->projectStructureProgressRepository->getStructureProject($id);
        $structureName=$this->structureRepository->parentList($project->sector);
            $projectStructures= $this->projectStructureRepository->getByProjectId($id);
            $structureEst= $projectStructures->mapWithKeys(function($item){
                   return [$item['structure_id']=>$item['estimation']];
               });
        return view('project.show', compact('project', 'baseline', 'beneficiary', 'institution', 'programs', 'obas', 'members', 'monitorings', 'vos', 'eots','workerDetails',
        'grievanceDetails','grievanceCommitte','qcTestDetails','safeguardDetails','month','casts','projectsource','projectdetail','projectreservoir','environment','safeguardIndicatorDetails','structure_progress'
    ,'structureName','structureEst'));
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
            $edits['project'] = $this->projectRepository->findById($id);
            if ($edits['project'] != null && $edits['project']->count() > 0) {
                $baselinesBefore = $this->baselineRepository->findByProjectId($id, 'before');
                $baselinesAfter = $this->baselineRepository->findByProjectId($id, 'after');
                $edits['address'] = $this->projectDistrictRepository->findByProjectId($id);
                $edits['sources'] =$this->projectsourceRepository->findByProjectId($id);
                $edits['details']=$this->projectdetailsRepository->findByProjectId($id);   
                
                $edits['reservoirs'] =$this->projectreservoirRepository->findByProjectId($id);
                
                
                $edits['before'] = '';
                $edits['after'] = '';
                
                if ($baselinesBefore != null) {
                    $edits['before'] = $baselinesBefore;
                }
                if ($baselinesAfter != null) {
                    $edits['after'] = $baselinesAfter;
                }
                
                $project_regions = $this->projectRegionRepository->all();
                $projectType=$this->projecttypeRepository->getTypeBySectorName();
               
                $projectTypeName=$this->projecttypeRepository->getBySectorName($edits['project']['sector']);
                    
                $districts = $this->districtRepository->all();
                $municipalities = $this->muniRepository->getMuniByDistrict();              
                $municipality = $this->muniRepository->allMuni();
                $fiscal_years = $this->fyRepository->all();
                $pmoDetails= $this->pmoRepository->all();

                return view('project.edit', compact('edits', 'project_regions', 'districts', 'municipalities', 'fiscal_years', 'municipality','pmoDetails','projectType','projectTypeName'));
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
    public function update(EditprojectRequest $request, $id)
    {
        $id = (int)$id;
        // $obaContractDetails=$request->oba;
        $projectsDetails = $request->project;               
        $projectSources=$request->sources;    
        $projectReservoir=$request->reservoirs;
        $projectType=$request->details;
        $projectsDetails['latest_eot'] = $projectsDetails['completion_date_stage1'];
        $projectsDetails['revised_stage2_date'] = $projectsDetails['completion_date_stage2'];
        $projectsDetails['latest_revised_contract_amount'] = $projectsDetails['contract_amount'];
        $projectsDetails['latest_revised_cost_estimated'] = $projectsDetails['estimated_amount']?$projectsDetails['estimated_amount']:0;
        $address = $request->address;
        $baseDetailsBefore = $request->before;
        $baseDetailsBefore['project_id'] = $id;
        $baseDetailsBefore['base_line_type'] = 'before';
        $baseDetailsAfter = $request->after;
        $baseDetailsAfter['project_id'] = $id;
        $baseDetailsAfter['base_line_type'] = 'after';

        try {
            DB::beginTransaction();
            $project = $this->projectRepository->findById($id);

            if ($project) {
                    if ($request->hasFile('files')) {

                        $image = $request->file('files');
                        $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                        $directories = storage_path('/app/public/uploads/oba');
                        if (!file_exists($directories)) {
                            Storage::makeDirectory('app/public/uploads/oba');
                        }
        
                        $image->move(storage_path() . '/app/public/uploads/oba/', $newName);
        
                        $projectsDetails['oba_file'] = $newName;
                    }
                
                $project->fill($projectsDetails)->save();
                $addressUpdate = $this->projectDistrictRepository->findByProjectId($id);
                if (!$addressUpdate->isEmpty()) {
                    foreach ($addressUpdate as $key => $value) {
                        $value->delete();
                    }
                }
                foreach ($address as $key => $value) {
                    $value['project_id'] = $id;
                    ProjectDistrict::create($value);
                }
                $projecttype=$this->projectdetailsRepository->findByProjectId($id);  
                $projectType['project_id']=$id;  
                
                if($projectsDetails['sector']!="water_supply") {
                    $projectType['base_year_pvt_connection']=null;
                    $projectType['design_year_pvt_connection']=null;
                    $projectType['base_year_water_demand']=null;
                    $projectType['design_year_water_demand']=null;
                    $projectType['treated_water_dicharge']=null;
                    $projectType['existing_treatment_detail']=null;
                    $projectType['proposed_treatment_detail']=null;
                    
                    
                 } 
                 if($projecttype!=null)
                 {
                    $projecttype->fill($projectType)->save();

                 }else{
                     ProjectDetails::create($projectType); 
                 }
                if(!$request->has('buttonId')){

                
                $projectsource=$this->projectsourceRepository->findByProjectId($id);    
                $projectreservoir=$this->projectreservoirRepository->findByProjectId($id);              
                $baselinesBefore = $this->baselineRepository->findByProjectId($id, 'before');
                $baselinesAfter = $this->baselineRepository->findByProjectId($id, 'after');

                        if($projectsource!=null)
                        {
                            foreach($projectsource as $value)
                            {
                                $value->delete();
                            }  
                         }    

                     if($projectreservoir!=null)
                        {
                            foreach($projectreservoir as $value)
                            {
                                $value->delete();
                             }  
                         }  

                            if($projectsDetails['sector']=="water_supply")
                            {
                              
                                foreach($projectSources as $key=>$value)
                                {
                                    $value['project_id']=$id;
                                    ProjectSourceDetails::create($value);
                                }

                                foreach($projectReservoir as $key=>$value)
                                {
                                    $value['project_id']=$id;                               
                                  ProjectReservoirs::create($value);
                                }
                            }

                        

                      

                                                                             
                            
                if ($baselinesBefore != null) {
                    $baselinesBefore->update($baseDetailsBefore);
                } else {
                    BaseLines::create($baseDetailsBefore);
                }
                if ($baselinesAfter != null) {
                    $baselinesAfter->update($baseDetailsAfter);
                } else {
                    BaseLines::create($baseDetailsAfter);
                }
            }
                
            DB::select("call progrssData(".$id.")");

                DB::commit();
                session()->flash('success', 'Projects updated successfully!');
                return redirect(route('details.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                DB::rollback();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->projectRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Project  successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }


    public function projectDetails($id)
    {
        $details = $this->projectRepository->findById($id);
        return $details;
    }
    public function projectType(Request $request)
    {
        $data= $this->projecttypeRepository->getTypeBySector($request->sector);
        return $data;
    }
    public function deleteFile($id, $picName)
    {
        $project = $this->projectRepository->findById($id);
        if ($project != null) {
            if ($project->oba_file != null) {
                @unlink(storage_path('/app/public/uploads' . '/' . 'oba/'  .$project->oba_file));

                $project->update(['oba_file' => null]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }
}
