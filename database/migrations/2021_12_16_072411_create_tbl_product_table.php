<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('item_id');
            $table->string('product_name');
            $table->float('product_price', 30);
            $table->float('product_old_price', 30);
            $table->integer('product_quantity', 11);
            $table->string('product_image');
            $table->integer('product_status');
            $table->text('meta_keywords');
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('tbl_product');
    }
}
