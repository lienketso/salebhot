<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('name')->nullable();
            $table->string('visual')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        Schema::create('option_values', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('option_id')->nullable();
            $table->string('value')->nullable();
            $table->double('label')->default(0);
            $table->timestamps();
        });
//        Schema::create('skus', function (Blueprint $table) {
//            $table->id();
//            $table->integer('product_id')->nullable();
//            $table->string('name')->nullable();
//            $table->string('barcode')->nullable();
//            $table->integer('price')->default(0);
//            $table->integer('stock')->default(0);
//            $table->timestamps();
//        });
//        Schema::create('variants', function (Blueprint $table) {
//            $table->id();
//            $table->integer('product_id')->nullable();
//            $table->integer('sku_id')->nullable();
//            $table->integer('option_id')->nullable();
//            $table->integer('option_value_id')->default(0);
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('option_value');
        Schema::dropIfExists('skus');
        Schema::dropIfExists('variants');
    }
}
