<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblQuanhuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_quanhuyen', function (Blueprint $table) {
            $table->id('maqh');
            $table->unsignedBigInteger('matp');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
            $table->foreign('matp')->references('matp')->on('tbl_tinhthanhpho');


            // $table->increments('product_id');
            // $table->integer('category_id');
            // $table->integer('brand_id');
            // $table->string('product_name');
            // $table->text('product_desc');
            // $table->text('product_content');
            // $table->string('product_price');
            // $table->string('product_image');
            // $table->integer('product_status');
            // $table->text('meta_keywords');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_quanhuyen');
    }
}
