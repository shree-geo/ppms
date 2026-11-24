<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBeneficiary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->integer('dalit_hh')->nullable();
            $table->integer('janjati_hh')->nullable();
            $table->integer('bramin_hh')->nullable();
            $table->integer('other_hh')->nullable();
            $table->integer('muslim_hh')->nullable();
    
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary', function (Blueprint $table) {
            //
        });
    }
}
