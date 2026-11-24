<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            //Government of Neapl Standard
            $table->string('gon_tor_approval')->nullable();
            $table->date('gon_tor_approval_date')->nullable();
            // $table->string('gon_draft_iee')->nullable();
            // $table->date('gon_draft_iee_date')->nullable();
            // $table->string('gon_presen_iee')->nullable();
            // $table->date('gon_presen_iee_date')->nullable();
            // $table->string('gon_final_iee')->nullable();
            // $table->date('gon_final_iee_date')->nullable();
            $table->string('gon_approval_iee')->nullable();
            $table->date('gon_approval_iee_date')->nullable();

                //ADB standard

            // $table->string('adb_report_submi')->nullable();
            // $table->date('adb_report_submi_date')->nullable();
            $table->string('adb_report_disclosed')->nullable();
            $table->date('adb_report_disclosed_date')->nullable();
            // $table->string('adb_revised_iee')->nullable();
            // $table->date('adb_revised_iee_date')->nullable();
            $table->string('adb_final_approval')->nullable();
            $table->date('adb_final_approval_date')->nullable();

                //EMP Monitoring Indicator
            $table->enum('emp_ssemp_prepared',['y','n'])->nullable()->comment('SS-EMP Prepared & Approved');
            $table->string('focal_person')->nullable()->comment('Apoint of EHS Focal person (Contractor)');

            //Safeguard Monitoring Indicators
              $table->enum('safe_statutory_clearance',['y','n'])->nullable()->comment('Compliance With Statutory Clearances ');
              $table->enum('safe_envi_clearance',['y','n'])->nullable()->comment('Environmental Clearance (EC), IEE approved');
              $table->enum('safe_site_clearance',['y','n'])->nullable()->comment('Site location clearance');
              $table->enum('safe_tree_cutting',['y','n'])->nullable()->comment('Tree-cutting permit');
              $table->enum('safe_no_objection',['y','n'])->nullable()->comment('No Objection Certificate/Letter for work from concern authority ');
              $table->enum('safe_construct_permit',['y','n'])->nullable()->comment('Permit/Consent to Construct (or equivalent)');
              $table->enum('safe_operate_permit',['y','n'])->nullable()->comment('Permit/Consent to Operate (or equivalent)');
              $table->enum('safe_road_cutting_permit',['y','n'])->nullable()->comment('Road-cutting permit');
              $table->enum('safe_utility_shifting_permit',['y','n'])->nullable()->comment('Utilities shifting permit');
              $table->enum('safe_covid_reponse',['y','n'])->nullable();
              $table->enum('safe_mou',['y','n'])->nullable();
              $table->string('safe_mou_file')->nullable();
              $table->string('gon_tor_approval_file')->nullable();
              $table->string('gon_iee_file')->nullable();
              $table->string('adb_approval_file')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('environments');
    }
}
