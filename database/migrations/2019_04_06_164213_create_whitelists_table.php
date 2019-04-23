<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whitelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('licence_plate');
            $table->foreign("licence_plate")->references('licence_plate')->on('cars')->onDelete('cascade');
            $table->timestamp("from")->nullable();
            $table->timestamp("to")->nullable();
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
        Schema::dropIfExists('whitelists');
    }
}
