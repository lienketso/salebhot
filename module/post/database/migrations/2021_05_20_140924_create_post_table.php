<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('category')->default(0);
            $table->string('slug')->nullable();
            $table->string('address')->nullable();
            $table->string('price_value')->nullable();
            $table->string('end_date')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->integer('display')->default(0); //lựa chọn vị trí hiển thị
            $table->integer('count_view')->default(0); //lưu lượt xem bài
            $table->string('tags')->nullable(); //từ khóa
            $table->integer('user_post')->default(0); //user post bài
            $table->integer('user_edit')->default(0); //user post bài
            $table->string('post_type')->default('blog');
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
        Schema::dropIfExists('post');
    }
}
