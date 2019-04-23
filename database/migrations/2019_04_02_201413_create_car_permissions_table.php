<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("l_p");
            $table->foreign("l_p")->references('licence_plate')->on('cars')->onDelete('cascade');
            $table->boolean("is_allowed");
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
        Schema::dropIfExists('car_permissions');
    }
}
