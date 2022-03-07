<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('steamid')->unique();
            $table->string('avatar');
            $table->integer('balance');
            $table->integer('totalDeposit');
            $table->integer('totalSpent');
            $table->integer('totalWithdraw');
            $table->boolean('faucet')->default(false);
            $table->string('referralCode')->unique()->nullable();
            $table->string('tradeToken')->nullable();
            $table->bigInteger('referredBy')->nullable();
            $table->integer('role')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
