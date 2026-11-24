<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->date('date');
            $table->string('type');
            $table->string('leadBy');
            $table->text('participant');
            $table->integer('no_of_participant');
            
            $table->text('social_observation')->nullable();
            $table->text('social_suggestion')->nullable();
            $table->text('social_improvement')->nullable();

            $table->text('technical_observation')->nullable();
            $table->text('technical_suggestion')->nullable();
            $table->text('technical_improvement')->nullable();

            $table->text('env_observation')->nullable();
            $table->text('env_suggestion')->nullable();
            $table->text('env_improvement')->nullable();

            $table->text('gesi_observation')->nullable();
            $table->text('gesi_suggestion')->nullable();
            $table->text('gesi_improvement')->nullable();

            $table->string('file')->nullable();
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
        Schema::dropIfExists('monitorings');
    }
}
