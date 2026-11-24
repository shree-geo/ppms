<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->enum('beneficiary_sector',['water_supply','sanitation','drainage']);
            $table->integer('dalit_f')->nullable();
            $table->integer('dalit_m')->nullable();
            $table->integer('janjati_f')->nullable();
            $table->integer('janjati_m')->nullable();
         
            $table->integer('bramin_f')->nullable();
            $table->integer('bramin_m')->nullable();
          
            $table->integer('other_f')->nullable();
            $table->integer('other_m')->nullable();
          
            $table->integer('muslim_f')->nullable();
            $table->integer('muslim_m')->nullable();
        
            $table->enum('status',['submitted','approved','canceled','revision'])->default('submitted');
            $table->date('status_date');

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
        Schema::dropIfExists('beneficiaries');
    }
}
