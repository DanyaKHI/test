<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');

            $table->index('product_id','product_category_product_idx');
            $table->index('category_id','product_category_category_idx');

            $table->foreign('product_id', 'product_category_product_fk')->on('products')->references('id');
            $table->foreign('category_id', 'product_category_category_fk')->on('categories')->references('id');

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
        Schema::dropIfExists('product_categories');
    }
};
