<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentalMonthlyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environmental_monthly_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('env_group_id')->unsigned();
            $table->foreign('env_group_id')->references('id')->on('environmental_monthlies')->onDelete('cascade');
            $table->integer('year');
            $table->integer('month');
            $table->enum('status',['y','n','na'])->nullable();
            $table->string('result')->nullable();
            $table->string('file')->nullable();
            $table->text('remarks')->nullable();
            $table->text('issue')->nullable();
            $table->text('action')->nullable();
            $table->string('responsible_body')->nullable();
            $table->string('target_time')->nullable();
            $table->enum('approve_status',['submitted','approved','canceled','revision'])->default('submitted');
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
        Schema::dropIfExists('environmental_monthly_records');
    }
}
