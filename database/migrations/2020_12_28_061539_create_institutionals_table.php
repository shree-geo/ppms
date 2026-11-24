<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            // $table->enum('type',['fixed','floating'])->comment('School,HealthPost,Hotel etc..');
            $table->string('institution_name');
            $table->enum('institution_type', ['school', 'healthpost', 'others']);
            $table->integer('total_female');
            $table->integer('total_male');
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
        Schema::dropIfExists('institutionals');
    }
}
