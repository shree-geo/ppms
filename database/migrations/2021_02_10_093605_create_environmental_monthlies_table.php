<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentalMonthliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environmental_monthlies', function (Blueprint $table) {
             $table->increments('id');
            $table->string('title');
            $table->enum('group_name',['ssEmp','environmental','risk','safety','community','issues','socialSafeguard']); 
            //ssEmp=Submission of SS-EMP Monitoring report (Monthly by Contractor ) 
            //environmental=Environmental monitoring results 
            //risk=Risk assessment of various activities
            //safety=The Safety Facilities
            //community=Community Safety
            //issues=Issues and Corrective Actions
            
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
        Schema::dropIfExists('environmental_monthlies');
    }
}
