<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->enum('base_line_type',['before','after'])->default('before');
            $table->string('private_conn')->nullable();
            $table->string('public_tap')->nullable();
            $table->string('source')->nullable();
            $table->string('average_time')->nullable();
            $table->string('per_capita')->nullable();
            $table->string('quality')->nullable();
            $table->string('public_toilet')->nullable();
            $table->string('water_seal')->nullable();
            $table->string('vip')->nullable();
            $table->string('pit_latrine')->nullable();
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
        Schema::dropIfExists('base_lines');
    }
}
