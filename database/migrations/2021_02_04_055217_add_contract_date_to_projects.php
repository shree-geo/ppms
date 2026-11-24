<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractDateToProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('pbg_issued_date')->nullable()->after('dlp_date');
            $table->date('pbg_expiry_date')->nullable()->after('pbg_issued_date');
            $table->date('apg_issued_date')->nullable()->after('pbg_expiry_date');
            $table->date('apg_expiry_date')->nullable()->after('apg_issued_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
