<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->string('url', 400);
            $table->integer('catID');
            $table->integer('subCatID')->nullable();
            $table->integer('brandID')->nullable();
            $table->string('stock')->nullable();
            $table->longText('small_image');
            $table->longText('lg_image_1');
            $table->longText('lg_image_2')->nullable();
            $table->longText('lg_image_3')->nullable();
            $table->double('previous_price')->nullable();
            $table->double('price');
            $table->string('short_description', 500);
            $table->string('description', 2000);
            $table->string('meta_title', 400);
            $table->string('meta_data', 900);
            $table->integer('active')->default('1');
            
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
