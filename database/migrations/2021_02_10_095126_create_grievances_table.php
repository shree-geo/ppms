<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrievancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grievances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->text('issue')->nullable();
            $table->text('files')->nullable();
            $table->enum('grievance_level',['first','second','third']);
            $table->string('complain_by')->nullable();
            $table->date('complain_date')->nullable();
            $table->string('affected_site')->nullable();
            $table->text('action_taken')->nullable();
            $table->enum('current_status',['solved','in_process','pending','discard'])->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('grievances');
    }
}
