<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_detail', function (Blueprint $table) {
            $table->increments('product_detail_id');
            $table->integer('product_id');
            $table->text('desc');
            $table->text('content');
            $table->string('cpu');
            $table->string('ram');
            $table->string('hard_drive');
            $table->string('screen');
            $table->string('card_screen');
            $table->string('connection');
            $table->string('especially');
            $table->string('operating_system');
            $table->string('design');
            $table->string('size_mass');
            $table->string('release_time');
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
        Schema::dropIfExists('tbl_product_detail');
    }
}
