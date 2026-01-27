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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->string('payment_type', 50)->nullable(); // gopay, qris, bank_transfer
            $table->string('transaction_id', 100)->nullable();
            $table->string('snap_token')->nullable();

            $table->enum('transaction_status', [
                'pending',
                'settlement',
                'expire',
                'cancel',
                'failure'
            ])->default('pending');

            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->dateTime('transaction_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
