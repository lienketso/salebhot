<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('tax_name')->nullable(); //Mã số thuế
            $table->string('moneyrule')->nullable(); //Vốn điều lệ
            $table->string('operating_year')->nullable(); //Năm thành lập
            $table->string('legal_type')->nullable(); //Loại hình pháp lý ( Cổ phần, TNHH, Tư nhân, hợp danh...)
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable(); // Mô tả về công ty
            $table->longText('content')->nullable(); // Chi tiết về công ty
            $table->string('thumbnail')->nullable();
            $table->text('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->integer('useradd')->default(0);
            $table->integer('count_view')->default(0); // Lượt xem
            $table->integer('display')->default(0); // Vị trí hiển thị trên web
            $table->enum('operating_status',['active','disable'])->default('active'); // Tình trạng hoạt động
            $table->enum('status',['active','disable'])->default('active'); // Vị trí hiển thị trên web
            $table->enum('lang_code',['vn','en'])->default('vn'); // Vị trí hiển thị trên web
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
        Schema::dropIfExists('company');
    }
}
