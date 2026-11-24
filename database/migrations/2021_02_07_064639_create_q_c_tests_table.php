<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQCTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_c_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->integer('test_type_id')->unsigned();
            $table->foreign('test_type_id')->references('id')->on('test_types')->onDelete('cascade');
            $table->integer('year');
            $table->integer('month');
            $table->string('test_by');
            $table->date('test_date');
            $table->string('followed_code');
            $table->enum('test_location', ['site', 'lab']);
            $table->string('obaserved_result');
            $table->string('result');
            $table->string('output_result');
            $table->string('report_file')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('q_c_tests');
    }
}
