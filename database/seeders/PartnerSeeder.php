<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['school', 'government'];

        for ($i = 1; $i <= 20; $i++) {
            $name = fake()->company();

            Partner::create([
                'name' => $name,
                'category' => fake()->randomElement($categories),
                'description' => fake()->paragraph(3),
                'activity_description' => fake()->boolean(70) ? fake()->paragraph(2) : null,

                // gambar dummy
                'image' => 'partners/dummy' . fake()->numberBetween(1, 5) . '.png',
            ]);
        }

    }
}
