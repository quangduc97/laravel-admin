<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name');
            $table->string('pro_slug');
            $table->integer('pro_price');
            $table->string('pro_img');
            $table->string('pro_warranty');
            $table->string('pro_accessories');
            $table->string('pro_condition');
            $table->string('pro_promotion');
            $table->tinyInteger('pro_status');
            $table->text('pro_description');
            $table->tinyInteger('pro_featured');
            $table->integer('pro_cate')->unsigned();
            $table->foreign('pro_cate')
                  ->references('cate_id')
                  ->on('categories')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
