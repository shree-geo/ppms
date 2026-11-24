<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('program_type_id')->unsigned();
            $table->foreign('program_type_id')->references('id')->on('program_types');
            $table->string('program_title');
            $table->string('program_details');
            $table->string('program_files')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('bramin_f');
            $table->integer('bramin_m');
            $table->integer('dalit_f');
            $table->integer('dalit_m');
            $table->integer('janjati_f');
            $table->integer('janjati_m');
            $table->integer('others_f');
            $table->integer('others_m');
            $table->integer('muslim_f');
            $table->integer('muslim_m');
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
        Schema::dropIfExists('programs');
    }
}
