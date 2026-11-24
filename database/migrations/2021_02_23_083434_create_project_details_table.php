<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
          $table->increments('id');
         $table->integer('project_id')->unsigned();
         $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
         $table->integer('project_type_id')->unsigned();
         $table->foreign('project_type_id')->references('id')->on('project_types');
         $table->text('existing_treatment_detail')->nullable();
         $table->text('proposed_treatment_detail')->nullable();
         $table->integer('base_year_pvt_connection')->nullable();
         $table->integer('design_year_pvt_connection')->nullable();
         $table->integer('base_year_water_demand')->nullable();
         $table->decimal('design_year_water_demand')->nullable();
         $table->decimal('treated_water_dicharge')->nullable();


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
        Schema::dropIfExists('project_details');
    }
}
