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
        Schema::table('free_trials', function (Blueprint $table) {
            // Menambahkan kolom is_read dengan default false (belum dibaca)
            $table->boolean('is_read')->default(false)->after('message'); 
        });
    }

    public function down(): void
    {
        Schema::table('free_trials', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }
};
