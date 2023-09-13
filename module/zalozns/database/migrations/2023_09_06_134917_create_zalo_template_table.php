<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZaloTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zalo_template', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('template_number')->nullable();
            $table->string('template_model')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
        Schema::create('zalo_template_param',function (Blueprint $table){
           $table->id();
           $table->integer('template_id')->nullable();
           $table->string('param_key')->nullable();
           $table->string('param_value')->nullable();
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
        Schema::dropIfExists('zalo_template');
        Schema::dropIfExists('zalo_template_param');
    }
}
