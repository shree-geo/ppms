<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oba_details', function (Blueprint $table) {
            $table->id();
            $table->integer('obas_id')->unsigned();
            $table->foreign('obas_id')->references('id')->on('obas')->onDelete('cascade');
            $table->string('owner_name');
            $table->integer('casts_id');
            $table->integer('family_size');
            $table->integer('male_count');
            $table->integer('female_count');
            $table->boolean('househead_women');
            $table->enum('oba_status',['started','not_started','completed','inuse','connected','not_connected']);
            $table->date('start_date')->nullable();
            $table->date('complete_date')->nullable();
            $table->date('inuse_date')->nullable();

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
        Schema::dropIfExists('oba_details');
    }
}
