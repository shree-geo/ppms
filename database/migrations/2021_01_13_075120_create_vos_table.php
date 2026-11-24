<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vos', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('serial_no');
            $table->float('variation_per');
            $table->decimal('revised_cost_estimated');
            $table->decimal('revised_contract_amount');
            $table->decimal('variation_amount');
            $table->date('approved_date');
            $table->string('approved_by');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('vos');
    }
}
