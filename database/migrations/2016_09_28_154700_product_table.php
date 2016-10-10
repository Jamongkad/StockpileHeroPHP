<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('company_id');
            $table->string('product_name');
            $table->string('sku');
            $table->string('barcode');
            $table->text('description');
            $table->string('image');
            $table->integer('initial_inventory');
            $table->integer('allocation');
            $table->integer('available');
            $table->decimal('initial_cost', 5, 2);
            $table->decimal('purchase_price', 5, 2);
            $table->decimal('wholesale_price', 5, 2);
            $table->decimal('retail_price', 5, 2);
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
        //
        Schema::drop('products');
    }
}
