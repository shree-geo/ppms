<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->enum('category',['issue','meeting']);
            $table->integer('number');
            $table->text('issue');
            $table->text('files')->nullable();
            $table->date('date');
            $table->text('reason')->nullable();
            $table->text('responsibility')->nullable();
            $table->text('action')->nullable();
            $table->string('status')->nullable();
            $table->string('participation')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
