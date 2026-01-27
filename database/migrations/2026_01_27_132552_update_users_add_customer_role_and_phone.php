<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Tambah kolom phone
            $table->string('phone')->nullable()->after('email');

            // 2. Ubah enum role → tambah customer
            $table->enum('role', ['admin', 'guest', 'customer'])
                ->default('customer')
                ->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Balikin enum role ke kondisi awal
            $table->enum('role', ['admin', 'geust'])
                ->default('staff')
                ->change();
        });
    }
};
