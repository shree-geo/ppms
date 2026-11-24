<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('structure_id')->unsigned();
            $table->foreign('structure_id')->references('id')->on('structures');
            $table->integer('year');
            $table->integer('month');
            $table->decimal('target');
            $table->decimal('progress')->nullable();
            $table->decimal('target_for_next_month')->nullable();
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
        Schema::dropIfExists('structure_progress');
    }
}
