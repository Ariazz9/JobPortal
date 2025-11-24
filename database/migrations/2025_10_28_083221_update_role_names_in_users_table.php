<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ubah tipe kolom jadi string agar bisa diisi nilai baru
        Schema::table('users', function (Blueprint $table) {
            // Kita ubah jadi string, sama seperti di modul 
            $table->string('role')->default('user')->change();
        });

        // 2. Update data lama ke data baru
        DB::table('users')
            ->where('role', 'hr')
            ->update(['role' => 'admin']);
            
        DB::table('users')
            ->where('role', 'jobseeker')
            ->update(['role' => 'user']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Kembalikan data baru ke data lama
        DB::table('users')
            ->where('role', 'admin')
            ->update(['role' => 'hr']);

        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'jobseeker']);

        // 2. Kembalikan tipe kolom jadi enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['hr', 'jobseeker'])->default('jobseeker')->change();
        });
    }
};