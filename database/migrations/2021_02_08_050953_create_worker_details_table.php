<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('year');
            $table->integer('month');
            $table->integer('bramin_f');
            $table->integer('bramin_m');
            $table->integer('dalit_f');
            $table->integer('dalit_m');
            $table->integer('janjati_f');
            $table->integer('janjati_m');
            $table->integer('muslim_f');
            $table->integer('muslim_m');
            $table->integer('others_f');
            $table->integer('others_m');
            $table->integer('local_f');
            $table->integer('local_m');
            $table->integer('skill_male');
            $table->integer('skill_female');
            $table->integer('unskill_male');
            $table->integer('unskill_female');
   
            $table->enum('status',['submitted','approved','canceled','revision'])->default('submitted');
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
        Schema::dropIfExists('worker_details');
    }
}
