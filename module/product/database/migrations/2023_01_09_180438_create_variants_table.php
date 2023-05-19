<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Product\Models\Options;
use Product\Models\OptionValue;
use Product\Models\Product;
use Product\Models\Sku;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('skus', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
//            $table->string('name')->unique()->nullable();
//            $table->string('barcode')->unique()->nullable();
//            $table->decimal('price', 12)->default(0);
//            $table->integer('stock')->default(0);
//            $table->timestamps();
//        });
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('option_id')->nullable();
            $table->integer('option_value_id')->default(0);
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
        Schema::dropIfExists('variants');
//        Schema::dropIfExists('skus');
    }
}
