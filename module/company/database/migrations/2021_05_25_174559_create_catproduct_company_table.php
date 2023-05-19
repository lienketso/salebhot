<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatproductCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catproduct_company', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('company_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->primary(['company_id', 'cat_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catproduct_company');
    }
}
