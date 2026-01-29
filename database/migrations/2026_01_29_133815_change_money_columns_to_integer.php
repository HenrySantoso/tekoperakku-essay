<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('total_amount')->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('price')->change();
            $table->integer('subtotal')->change();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->integer('gross_amount')->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('integer', function (Blueprint $table) {
            //
        });
    }
};
