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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name');     // Nama Orang Tua
            $table->string('student_name');    // Nama Murid + Umur
            $table->string('course_name');     // Level/Kelas
            $table->text('review');            // Isi testimoni
            $table->string('parent_image')->nullable(); // Foto profil (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
