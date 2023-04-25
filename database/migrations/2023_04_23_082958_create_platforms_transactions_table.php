<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platform_transaction', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('platform_id');
            $table->foreign('platform_id')->references('id')->on('platforms');

            $table->unsignedInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_transaction');
    }
};
