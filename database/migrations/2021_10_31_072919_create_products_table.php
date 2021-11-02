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
            $table->string('name', 255);
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->string('picture', 255)->nullable();
            $table->string('slug')->unique();
            $table->string('short_desc', 500)->nullable();
            $table->longtext('description')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('product_cat_id');
            $table->timestamps();

            $table -> foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table -> foreign('product_cat_id')->references('id')->on('product_categories')->onDelete('cascade');
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
