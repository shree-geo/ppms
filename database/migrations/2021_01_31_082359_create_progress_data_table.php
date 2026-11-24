<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('revision');
            $table->string('year');
            $table->string('month');
            $table->integer('month_code');
            $table->decimal('target')->nullable();
            $table->decimal('progress')->nullable();
            $table->decimal('financial_progress')->nullable();
            $table->decimal('dispercement')->nullable();
            $table->enum('approve_rpmo',['y','n'])->default('n');
            $table->date('approve_rpmo_date')->nullable();
            $table->integer('approve_rpmo_user_id')->nullable();
            $table->enum('approve_pmo',['y','n'])->default('n');
            $table->date('approve_pmo_date')->nullable();
            $table->integer('approve_pmo_user_id')->nullable();
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
        Schema::dropIfExists('progress_data');
    }
}
