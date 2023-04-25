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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('token');
            $table->enum('transaction_type', ['C', 'D']);
            $table->tinyInteger('transaction_status')->comment('0=DECLINED,1=AUTHORIZED');
            $table->bigInteger('merchant_code');
            $table->string('merchant_name');
            $table->char('merchant_country', 3);
            $table->char('currency', 3);
            $table->float('amount', 8, 2);
            $table->char('transaction_currency', 3);
            $table->decimal('transaction_amount');
            $table->smallInteger('auth_code');
            $table->datetime('transaction_date');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->tinyInteger('sync_status')->default(0)->comment('0=PENDING,1=IN PROGRESS,2=SYNCED');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
