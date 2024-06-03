<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('minimum_withdrawal_amount');
            $table->integer('maximum_withdrawal_amount');
            $table->integer('the_lowest_amount_in_the_account');
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
        Schema::dropIfExists('withdrawal_settings');
    }
};
