<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('name')->nullable();
            $table->double('commission_amount')->default(0)->nullable('số tiền hoa hồng');
            $table->double('commission_rate')->default(0)->comment('tỉ lệ hoa hồng');
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
        Schema::dropIfExists('commissions');
    }
}
