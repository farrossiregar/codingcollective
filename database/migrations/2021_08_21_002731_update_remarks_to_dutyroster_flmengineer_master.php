<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemarksToDutyrosterFlmengineerMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dutyroster_flmengineer_master', function (Blueprint $table) {
            $table->char('remarks', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dutyroster_flmengineer_master', function (Blueprint $table) {
            //
        });
    }
}