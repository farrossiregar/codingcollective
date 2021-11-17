<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBulanTahunToPreventiveMaintenanceSow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventive_maintenance_sow', function (Blueprint $table) {
            $table->string('bulan',2)->nullable();
            $table->string('tahun',4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preventive_maintenance_sow', function (Blueprint $table) {
            //
        });
    }
}
