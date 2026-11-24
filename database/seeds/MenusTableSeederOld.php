<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        $rows = [

            [
                'parent_id' => '0',
                'menu_name' => 'Users',
                'menu_link' => '/user',
                'menu_controller' => 'UserController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-user-circle" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Roles',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-wrench" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Configuration',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '4'
            ],


            [
                'parent_id' => '0',
                'menu_name' => 'Logs',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-child" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],

            [
                'parent_id' => '2',
                'menu_name' => 'Menus',
                'menu_link' => '/roles/menu',
                'menu_controller' => 'MenuController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-list" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '0'
            ],

            [
                'parent_id' => '2',
                'menu_name' => 'User Groups',
                'menu_link' => '/roles/group',
                'menu_controller' => 'UserGroupController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-group" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
            [
                'parent_id' => '2',
                'menu_name' => 'Role Access',
                'menu_link' => '/roles/roleAccessIndex',
                'menu_controller' => 'RoleAccessController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-unlock" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Designation',
                'menu_link' => '/configurations/designation',
                'menu_controller' => 'DesignationController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],

            [
                'parent_id' => '3',
                'menu_name' => 'Fiscal Year',
                'menu_link' => '/configurations/fiscalYear',
                'menu_controller' => 'FiscalYearController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Department',
                'menu_link' => '/configurations/department',
                'menu_controller' => 'DepartmentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Country',
                'menu_link' => '/configurations/country',
                'menu_controller' => 'CountryController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '9'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Pradesh',
                'menu_link' => '/configurations/pradesh',
                'menu_controller' => 'PradeshController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '10'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Municipality Type',
                'menu_link' => '/configurations/muniType',
                'menu_controller' => 'MuniTypeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '11'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'District',
                'menu_link' => '/configurations/district',
                'menu_controller' => 'DistrictController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '13'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Municipality',
                'menu_link' => '/configurations/municipality',
                'menu_controller' => 'MunicipalityController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '13'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Office Type',
                'menu_link' => '/configurations/officeType',
                'menu_controller' => 'OfficeTypeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '14'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Office',
                'menu_link' => '/configurations/office',
                'menu_controller' => 'OfficeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '15'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'ProgramTypes',
                'menu_link' => '/configurations/programTypes',
                'menu_controller' => 'ProgramTypeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '16'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'OBATypes',
                'menu_link' => '/configurations/obaTypes',
                'menu_controller' => 'ObaTypeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '17'

            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Login Logs',
                'menu_link' => '/logs/loginLogs',
                'menu_controller' => 'LogController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-user-plus" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Failed Login Logs',
                'menu_link' => '/logs/failLoginLogs',
                'menu_controller' => 'LogController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-user-times" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],
 
           
            [
                'parent_id' => '3',
                'menu_name' => 'Document Category',
                'menu_link' => '/configurations/document_category',
                'menu_controller' => 'DocumentCategoryController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '18'

            ],

            [
                'parent_id' => '3',
                'menu_name' => 'PMO',
                'menu_link' => '/configurations/pmo',
                'menu_controller' => 'PmoController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '19'
            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Test Type',
                'menu_link' => '/configurations/test_type',
                'menu_controller' => 'TestTypeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '20'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Project Type',
                'menu_link' => '/configurations/projecttype',
                'menu_controller' => 'ProjectTypeController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '18'

            ],

             [
                'parent_id' => '3',
                'menu_name' => 'Structure',
                'menu_link' => '/configurations/structure',
                'menu_controller' => 'StructureController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '21'

            ],
               [
                'parent_id' => '3',
                'menu_name' => 'Features',
                'menu_link' => '/configurations/sailent_feature',
                'menu_controller' => 'SailentFeatureController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '22'

            ],
             [
                'parent_id' => '0',
                'menu_name' => 'Projects',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-bars"></i>',
                'menu_status' => '1',
                'menu_order' => '7'
            ],
              [
                'parent_id' => '28',
                'menu_name' => 'Project List',
                'menu_link' => '/project/details',
                'menu_controller' => 'ProjectController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
               [
                'parent_id' => '28',
                'menu_name' => 'Beneficiary Details',
                'menu_link' => '/project/beneficiary',
                'menu_controller' => 'BeneficiaryController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '2'

            ],
              [
                'parent_id' => '28',
                'menu_name' => 'Institutional Details',
                'menu_link' => '/project/institutional',
                'menu_controller' => 'InstitutionalController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],
             [
                'parent_id' => '28',
                'menu_name' => 'Workmanship Details',
                'menu_link' => '/project/workmanship',
                'menu_controller' => 'WorkmanshipController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '4'
            ],
                  [
                'parent_id' => '28',
                'menu_name' => 'Programs Details',
                'menu_link' => '/project/programs',
                'menu_controller' => 'ProgramsController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Oba Details',
                'menu_link' => '/project/oba',
                'menu_controller' => 'ObaController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '6'
            ],
            [
                'parent_id' => '28',
                'menu_name' => 'WUSC Information',
                'menu_link' => '/project/member',
                'menu_controller' => 'MemberController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '7'
            ],
                 [
                'parent_id' => '28',
                'menu_name' => 'Monitoring',
                'menu_link' => '/project/monitoring',
                'menu_controller' => 'MonitoringController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '8'
            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Vo Details',
                'menu_link' => '/project/vo',
                'menu_controller' => 'VoController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '10'
            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Eot Details',
                'menu_link' => '/project/eot',
                'menu_controller' => 'EotController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i',
                'menu_status' => '1',
                'menu_order' => '11'

            ],
             [
                'parent_id' => '28',
                'menu_name' => 'Documents',
                'menu_link' => '/project/document',
                'menu_controller' => 'DocumentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '12'
            ],
             [
                'parent_id' => '28',
                'menu_name' => 'ProgressData',
                'menu_link' => '/project/progressData',
                'menu_controller' => 'ProgressDataController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '13'
            ],
             [
                'parent_id' => '28',
                'menu_name' => 'Worker Details',
                'menu_link' => '/project/worker',
                'menu_controller' => 'WorkerController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '15'
            ],
             [
                'parent_id' => '28',
                'menu_name' => 'Environment Details',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '16'
            ],
               [
                'parent_id' => '42',
                'menu_name' => 'Environment',
                'menu_link' => '/project/environment_detail',
                'menu_controller' => 'EnvironmentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '17'
            ],
            [
                'parent_id' => '42',
                'menu_name' => 'Environmental Monthy Data',
                'menu_link' => '/project/environmental_monthly_record',
                'menu_controller' => 'EnvironmentalMonthlyRecordController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '18'
            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Grievance Details',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '19'
            ],
               [
                'parent_id' => '45',
                'menu_name' => 'Grievanace',
                'menu_link' => '/project/grievance_detail',
                'menu_controller' => 'GrievanceController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '20'

            ],
            [
                'parent_id' => '45',
                'menu_name' => 'Grievanace Committe',
                'menu_link' => '/project/grievanceCommitte',
                'menu_controller' => 'GrievanceCommitteController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '21'

            ],
         
            [
                'parent_id' => '28',
                'menu_name' => 'Social Safe Guard',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '22'

            ],
              [
                'parent_id' => '48',                
                'menu_name' => 'Social Safe Guard',
                'menu_link' => '/project/safeguard_detail',
                'menu_controller' => 'SafeguardController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '23'

            ],
            [
                'parent_id' => '48',
                'menu_name' => 'Safe Guard Indicators',
                'menu_link' => '/project/safeguardindicators',
                'menu_controller' => 'SafeGuardIndicatorsController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '24'

            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Quality Control Details',
                'menu_link' => '',
                'menu_controller' => '',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '25'

            ],
             [
                'parent_id' => '51',
                'menu_name' => 'Quality Control',
                'menu_link' => '/project/qualityControl',
                'menu_controller' => 'QualityControlController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '26'

            ],
            [
                'parent_id' => '51',
                'menu_name' => 'Quality Control Test',
                'menu_link' => '/project/qcTest',
                'menu_controller' => 'QCTestController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '27'

            ],
            
             [
                'parent_id' => '28',
                'menu_name' => 'Structure Details',
                'menu_link' => '',
                'menu_controller' => '',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '28'

            ],
                 [
                'parent_id' => '54',
                'menu_name' => 'Structure Estimation',
                'menu_link' => '/project/structure_estimation',
                'menu_controller' => 'ProjectStructureController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '29'

            ],
             [
                'parent_id' => '54',
                'menu_name' => 'Structure Progress',
                'menu_link' => '/project/structure_progress',
                'menu_controller' => 'ProjectStructureProgressController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '30'

            ],
            [
                'parent_id' => '28',
                'menu_name' => 'Salient Feature ',
                'menu_link' => '/project/features_value',
                'menu_controller' => 'SalientFeatureValueController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '31'

            ],
                 [
                'parent_id' => '28',
                'menu_name' => 'Staff Details',
                'menu_link' => '/project/staff',
                'menu_controller' => 'StaffController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '32'

            ],

            [
                'parent_id' => '28',
                'menu_name' => 'Issue Details',
                'menu_link' => '/project/issue',
                'menu_controller' => 'IssueController',                
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '33'

            ],
               [
                'parent_id' => '0',
                'menu_name' => 'Reports',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-bar-chart"></i>',
                'menu_status' => '1',
                'menu_order' => '8'
            ],
            [
                'parent_id' => '60',
                'menu_name' => 'S-curve',
                'menu_link' => 'reports/s-curve',
                'menu_controller' => 'ReportController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
            [
                'parent_id' => '60',
                'menu_name' => 'Index',
                'menu_link' => 'reports/all',
                'menu_controller' => 'ReportController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],
            [
                'parent_id' => '45',
                'menu_name' => 'Third Level Grievanace',
                'menu_link' => '/project/thirdlevelgrievance',
                'menu_controller' => 'ThirdLevelGrievanaceController',
                'menu_css' => '',
                'menu_icon' => '<i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '34'

            ],
            [
                'parent_id' => '3',
                'menu_name' => 'Materials',
                'menu_link' => '/configurations/material',
                'menu_controller' => 'MaterialController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '22'

            ],
             
            
              

        ];
        DB::table('menus')->insert($rows);
    }
}
