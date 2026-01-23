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
        Schema::create('hero', function (Blueprint $table) {
            $table->id();

        
            $table->string('image_id')->nullable(); // Indonesia 🇮🇩
            $table->string('image_en')->nullable(); // Inggris 🇺🇸
            $table->string('image_ja')->nullable(); // Jepang 🇯🇵
            $table->string('image_ar')->nullable(); // Arab 🇸🇦
            $table->string('image_bn')->nullable(); // Bengali 🇧🇩
            $table->string('image_fil')->nullable(); // Filipino 🇵🇭
            $table->string('image_ms')->nullable(); // Melayu 🇲🇾

           
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_desc')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};