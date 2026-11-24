<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_num');
            $table->string('loan_num');
            $table->date('loan_aggre_date');
            $table->decimal('loan_amount');
            $table->float('interest_rate');
            $table->date('loan_effective_date');
            $table->date('loan_closing_date');
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
        Schema::dropIfExists('pmos');
    }
}
