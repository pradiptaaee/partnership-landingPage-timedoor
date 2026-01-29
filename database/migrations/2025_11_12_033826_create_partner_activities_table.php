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
        Schema::create('partner_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')
                ->constrained('partners')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug', 150)->unique();
            $table->string('category_activity', 50);
            $table->date('activity_date');
            $table->longText('full_description');

            $table->string('featured_image')->nullable();
            $table->timestamps();

            // Indexes untuk performa
            $table->index('partner_id');
            $table->index('activity_date');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_activities');
    }
};
