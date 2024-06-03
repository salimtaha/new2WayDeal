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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained('stores')->nullOnDelete();
            $table->foreignId('mediator_id')->nullable()->constrained('mediators')->nullOnDelete();

            $table->foreignId('withdrawal_method')->constrained('withdrawal_methods')->cascadeOnDelete();
            $table->integer('number');
            $table->integer('amount');
            $table->enum('status' , ['pending' , 'accepted' , 'rejected']);
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
        Schema::dropIfExists('withdrawals');
    }
};
