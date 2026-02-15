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
        // Tabel khusus Seminar
        Schema::create('activity_seminar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_activity_id')->constrained('partner_activities')->cascadeOnDelete();
            $table->string('speaker_name');
            $table->text('speaker_about');
            $table->string('speaker_photo')->nullable();
            $table->timestamps();
        });

        // Tabel khusus Workshop
        Schema::create('activity_workshop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_activity_id')->constrained('partner_activities')->cascadeOnDelete();
            $table->string('mentor_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_category_tables');
    }
};
