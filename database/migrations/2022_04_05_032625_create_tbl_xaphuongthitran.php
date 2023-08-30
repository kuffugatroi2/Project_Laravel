<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblXaphuongthitran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_xaphuongthitran', function (Blueprint $table) {
            $table->id('xaid');
            $table->unsignedBigInteger('maqh');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
            $table->foreign('maqh')->references('maqh')->on('tbl_quanhuyen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_xaphuongthitran');
    }
}
