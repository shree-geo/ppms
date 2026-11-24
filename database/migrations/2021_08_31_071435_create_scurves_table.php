<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScurvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scurve', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('revision_name');
            $table->string('year');
            $table->string('month');
            $table->integer('month_code');
            $table->decimal('target')->nullable();
            $table->decimal('progress')->nullable();
            $table->decimal('financial_progress')->nullable();
            $table->decimal('dispercement')->nullable();
            $table->enum('data_value',['O','N'])->nullable();

            $table->integer('rid')->unsigned()->nullable();
            $table->foreign('rid')->references('id')->on('revision');
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
        Schema::dropIfExists('scurves');
    }
}
