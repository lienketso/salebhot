<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->double('balance')->default(0);
            $table->timestamps();
        });
        Schema::create('wallet_transaction', function (Blueprint $table){
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('wallet_id')->nullable();
            $table->string('transaction_type')->nullable()->comment('Loại giao dịch');
            $table->double('amount')->default(0);
            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('wallet_transaction');
    }
}
