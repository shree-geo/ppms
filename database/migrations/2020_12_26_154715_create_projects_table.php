<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('project_regions');
            $table->string('package_no');
            $table->string('name');
            $table->enum('sector', ['water_supply', 'sanitation', 'drainage']);
            $table->integer('reporting_fy_id')->unsigned();
            $table->foreign('reporting_fy_id')->references('id')->on('fiscal_years');
            $table->integer('proj_start_fy_id')->unsigned();
            $table->foreign('proj_start_fy_id')->references('id')->on('fiscal_years');
            $table->date('mou_signing_date')->nullable();
            $table->decimal('contract_amount');
            $table->string('ded_approv_date')->nullbale();
            $table->decimal('estimated_amount')->nullable();
            $table->date('contract_completion_date');
            $table->date('financial_aggre_date')->nullable();
            $table->date('ded_pre_to_comm_date')->nullable();
            $table->date('bid_docu_date')->nullable();
            $table->date('ifb_pub_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->string('aprro_contractor')->nullable();
            $table->date('contract_signing_date')->nullable();
            $table->date('completion_date_stage1')->nullable();
            $table->date('completion_date_stage2')->nullable();
            $table->string('dlp_date')->nullable();
            //workmanship skilled unskilled detail from the area
            $table->integer('skilled_manpower')->nullable();
            $table->integer('unskilled_manpower')->nullable();

            //socioeconomic detail

            $table->integer('survey_year')->nullable();
            $table->integer('survey_total_household')->nullable();
            $table->bigInteger('survey_total_population')->nullable();
            $table->decimal('survey_family_size')->nullable();


            $table->integer('base_year')->nullable();
            $table->integer('base_total_household')->nullable();
            $table->bigInteger('base_total_population')->nullable();

            $table->integer('design_year')->nullable();
            $table->integer('design_total_household')->nullable();
            $table->bigInteger('design_total_population')->nullable();

            $table->decimal('aff_high_income')->nullable();
            $table->decimal('aff_avg_income')->nullable();
            $table->decimal('aff_low_income')->nullable();
            $table->decimal('aff_bpl_income')->nullable();

            //Quality Control
            $table->string('qc_plan')->nullable();
            $table->date('qc_plan_submitted')->nullable();
            $table->string('qc_calibiration_test')->nullable();
            $table->date('qc_calibiration_test_submitted')->nullable();
            $table->string('qc_third_party')->nullable();
            $table->date('qc_third_party_submitted')->nullable();


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
        Schema::dropIfExists('projects');
    }
}
