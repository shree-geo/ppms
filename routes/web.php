<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
// Route::get('/', function () {
//     return Redirect::to('/login');
// });
//Route::get('/', 'HomeController@index');
Route::get('/clear_cache', 'ConfigController@clearRoute');


Route::group(['middleware' => ['auth']], function () {
Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::prefix('roles')->group(function () {
        Route::resource('/menu', 'Roles\MenuController');
        Route::get('/menu/menuControllerChangeStatus/{id}', 'Roles\MenuController@changeStatus');
        Route::resource('/group', 'Roles\UserGroupController');
        Route::get('/roleAccessIndex', 'Roles\RoleAccessController@index');
        Route::get('roleChangeAccess/{allowId}/{id}', 'Roles\RoleAccessController@changeAccess');
    });

    Route::resource('/user', 'UserController');
    Route::get('/user/status/{id}', 'UserController@status');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('profile/profilePic', 'UserController@profilePic');
    Route::post('/profile/password', 'UserController@password');

    Route::prefix('configurations')->group(function () {
        Route::resource('/designation', 'Configurations\DesignationController');
        Route::resource('/department', 'Configurations\DepartmentController');
        Route::resource('/fiscalYear', 'Configurations\FiscalYearController');
        Route::get('/fiscalYear/status/{id}', 'Configurations\FiscalYearController@status');
        Route::resource('/country', 'Configurations\CountryController');
        Route::get('/country/status/{id}', 'Configurations\CountryController@status');
        Route::resource('/pradesh', 'Configurations\PradeshController');
        Route::resource('/muniType', 'Configurations\MuniTypeController');
        Route::resource('/district', 'Configurations\DistrictController');
        Route::resource('/municipality', 'Configurations\MunicipalityController');
        Route::resource('/officeType', 'Configurations\OfficeTypeController');

        Route::resource('/office', 'Configurations\OfficeController');
        Route::get('/office/status/{id}', 'Configurations\OfficeController@status');
        Route::resource('/programTypes', 'Configurations\ProgramTypeController');
        Route::resource('/obaTypes', 'Configurations\ObaTypeController');
        Route::resource('/document_category', 'Configurations\DocumentCategoryController');
        Route::resource('/pmo', 'Configurations\PmoController');
        Route::resource('/test_type', 'Configurations\TestTypeController');
        Route::resource('/structure','Configurations\StructureController');
        Route::resource('/projecttype','Configurations\ProjectTypeController');
        Route::resource('/sailent_feature','Configurations\SailentFeatureController');
        Route::resource('/material','Configurations\MaterialController');

    });

    Route::prefix('logs')->group(function () {
        Route::get('/loginLogs', 'LogController@loginLogs');
        Route::get('/failLoginLogs', 'LogController@failLogin');
    });

    Route::resource('feedback', 'FeedbackController');
    Route::prefix('project')->group(function () {
        Route::resource('/details', 'ProjectController');
        Route::resource('/workmanship', 'WorkmanshipController');
        Route::resource('/beneficiary', 'BeneficiaryController');
        Route::resource('/institutional', 'InstitutionalController');
        Route::resource('/programs', 'ProgramsController');
        Route::get('/oba/import','ObaController@importObaData')->name('oba.import');
        Route::post('/oba/import','ObaController@importExcel');
        Route::resource('/oba', 'ObaController');
        Route::resource('/member', 'MemberController');
        Route::resource('/monitoring', 'MonitoringController');
        Route::resource('/loanStatus', 'LoanStatusController');
        Route::resource('/vo', 'VoController');
        Route::resource('/document', 'DocumentController');
        Route::resource('/eot', 'EotController');
        Route::resource('/progressData', 'ProgressDataController');
        Route::get('/progressDataProjectId', 'ProgressDataController@getProgressData')->name('progressDataByProject');
        Route::resource('/payment', 'PaymentController');
        Route::resource('/worker', 'WorkerController');
        Route::resource('/safeguardindicators', 'SafeGuardIndicatorsController');
        Route::resource('/staff', 'StaffController');
        Route::resource('/issue', 'IssueController');
    
        // Route::get('/oba/import/evenn',function()
        // {
        //     return "hello";
        // })->name('oba.import');

        Route::resource('/environment_detail', 'EnvironmentController');
        Route::get('/environmental_monthly/getData', 'EnvironmentalMonthlyRecordController@getProjectData');
        Route::resource('/environmental_monthly_record', 'EnvironmentalMonthlyRecordController');
        Route::get('/environmental_monthly_record/editData/{project_id}/{year}/{month}', 'EnvironmentalMonthlyRecordController@edit');
        Route::delete('/environmental_monthly_record/deleteData/{project_id}/{year}/{month}', 'EnvironmentalMonthlyRecordController@destroy');
        Route::get('environmental_monthly_record/show/{project_id}/{year}/{month}','EnvironmentalMonthlyRecordController@show');
        Route::resource('grievance_detail','GrievanceController');
        Route::resource('safeguard_detail','SafeguardController');
        
        Route::resource('/qualityControl', 'QualityControlController');
        Route::resource('/qcTest', 'QCTestController');
        Route::post('/qcModel', 'QualityControlController@qcModal');
        Route::post('programs/programsStatus', 'ProgramsController@updateStatus');
        Route::post('beneficiary/beneficiaryStatus','BeneficiaryController@updateStatus');
        Route::post('worker/workerStatus','WorkerController@updateStatus');
        Route::post('institution/institutionStatus','InstitutionalController@updateStatus');
        Route::post('obas/obaStatus','ObaController@updateStatus');
        Route::post('qcTest/QcTestStatus','QCTestController@updateStatus');
        Route::post('/env_monthly_approve','EnvironmentalMonthlyRecordController@updateStatus');
  

        Route::resource('/grievanceCommitte', 'GrievanceCommitteController');
        Route::resource('/thirdlevelgrievance', 'ThirdLevelGrievanaceController');

        Route::resource('/sources', 'ProjectController');
        Route::get('/getBySector','ProjectController@projectType');

        Route::resource('/structure_estimation','ProjectStructureController');
        Route::resource('/structure_progress','ProjectStructureProgressController');
        Route::get('/structure_progress/editData/{project_id}/{year}/{month}', 'ProjectStructureProgressController@edit');
        Route::delete('/structure_progress/deleteData/{project_id}/{year}/{month}', 'ProjectStructureProgressController@destroy');

        Route::get('/estimationValue','ProjectStructureProgressController@getEstimationValue');
        Route::resource('/features_value','SalientFeatureValueController');

        Route::get('revision/getByProjectId/{project_id}','ProgressRevisionController@getRevisionByProject');
        Route::resource('revision','ProgressRevisionController');
        Route::resource('reportUpload','ReportsUploadController');
     
    
});
    Route::prefix('reports')->group(function () {
        Route::get('all','ReportController@index');
        Route::get('all/workers','ReportController@getWorkerReport');
        Route::get('s-curve', 'ReportController@getProgressData');
        Route::get('all/programs', 'ReportController@getProgramsData');
        Route::get('all/qcTest', 'ReportController@getQCTestData');
        Route::get('all/obas', 'ReportController@getObasData');
        Route::get('all/monthly_progress', 'ReportController@getMonthlyProgressData');
        Route::get('all/summary_report', 'ReportController@getSummaryReportData');
        Route::get('all/physical_financial', 'ReportController@getPhysicalFinancialReportData');
        Route::get('all/physical_financial_summary', 'ReportController@getGeneralizedPFReport');
        Route::get('all/samiti_member','ReportController@getSamitiMemberReport');
        
    });

    Route::get('delete/monitoring/{id}/{name}', 'MonitoringController@deleteImage');
    Route::get('delete/document/{id}/{name}', 'DocumentController@deleteImage');
    Route::get('delete/qcTest/{id}/{name}', 'QCTestController@deleteFile');
    Route::get('delete/safeguard/{id}/{name}', 'SafeGuardIndicatorsController@deleteFile');
    Route::get('delete/issues/{id}/{name}', 'IssueController@deleteFile');
    
    Route::get('delete/grievances/{id}/{name}', 'GrievanceController@deleteFile');
    Route::get('delete/programs/{id}/{name}', 'ProgramsController@deleteFile');
    Route::get('delete/project/{id}/{name}', 'ProjectController@deleteFile');
    
    Route::get('delete/reports/{id}', 'ReportsUploadController@deleteImage');
    
    Route::get('projectDetails/{project_id}', 'ProjectController@projectDetails');
    Route::get('progress/{project_id}', 'ProgressDataController@projectDetails');
    Route::delete('progress/{id}', 'ProgressDataController@destroy');

    Route::get('delete/eot/{id}/{name}', 'EotController@deleteImage');
    Route::get('delete/vo/{id}/{name}', 'VoController@deleteImage');
    Route::get('delete/environmental/{id}/{name}', 'EnvironmentalMonthlyRecordController@deleteImage');
    Route::get('delete/environment/{id}/{col_name}/{name}', 'EnvironmentController@deleteImage');

  
});