<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectcode5DanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dana_stpl_master', function (Blueprint $table) {
            $table->integer('cmi')->nullable();
            $table->integer('h3i')->nullable();
            $table->integer('isat')->nullable();
            $table->integer('stp')->nullable();
            $table->integer('xl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}