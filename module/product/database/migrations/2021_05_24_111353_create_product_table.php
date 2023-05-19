<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('cat_id')->default(0);
            $table->integer('company_id')->default(0);
            $table->double('price')->default(0);
            $table->double('disprice')->default(0);
            $table->integer('discount')->default(0);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->tinyInteger('display')->default(0); //lựa chọn hiển thị
            $table->enum('status',['active','disable'])->default('active');
            $table->integer('user_post')->default(0); //user post bài
            $table->integer('user_edit')->default(0); //user sửa bài
            $table->integer('count_view')->default(0);
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
        Schema::dropIfExists('product');
    }
}
