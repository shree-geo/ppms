<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('ofc_name');
            $table->string('department');
            $table->string('name');
            $table->integer('designaion_id');
            $table->enum('gender',['male','female','other']);
            $table->bigInteger('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->date('join_date');
            $table->date('end_date')->nullable();
            $table->enum('status',['active','inactive']);


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
        Schema::dropIfExists('staff');
    }
}
