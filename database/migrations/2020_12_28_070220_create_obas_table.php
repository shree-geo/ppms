<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('oba_types_id')->unsigned();
            $table->foreign('oba_types_id')->references('id')->on('oba_types');
            $table->integer('dis_id')->unsigned();
            $table->foreign('dis_id')->references('id')->on('districts');
            $table->integer('year');
            $table->integer('months');
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
        Schema::dropIfExists('obas');
    }
}
