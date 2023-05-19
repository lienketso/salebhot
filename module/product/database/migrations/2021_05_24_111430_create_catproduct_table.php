<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('description')->default(0);
            $table->string('thumbnail')->nullable();
            $table->string('content')->nullable();
            $table->text('link')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('display')->default(0);
            $table->enum('status',['active','disable'])->default('active');
            $table->enum('lang_code',['vn','en'])->default('vn');
            $table->timestamps();
        });

        Schema::create('catproduct', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('parent')->default(0);
            $table->string('thumbnail')->nullable();
            $table->string('background')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('display')->default(0);
            $table->enum('status',['active','disable'])->default('active');
            $table->enum('lang_code',['vn','en'])->default('vn');
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
        Schema::dropIfExists('catproduct');
    }
}
