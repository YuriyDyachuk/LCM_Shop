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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name');
            $table->string('sku')->comment('Stock keeping unit');
            $table->unsignedDecimal('price', 10, 2)->nullable();
            $table->unsignedSmallInteger('quantity')->nullable();
            $table->boolean('in_stock')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_virtual')->default(0);
            $table->timestamps();

            $table->unique('sku', 'sku_unique');

            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
