<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Partner;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;

class PartnershipSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Seed 5 partners
        $partners = collect([
            [
                'name' => 'Tech Innovators',
                'category' => 'Technology',
                'description' => 'Perusahaan berbasis teknologi yang fokus pada AI dan IoT.',
            ],
            [
                'name' => 'Edu Global',
                'category' => 'Education',
                'description' => 'Lembaga pendidikan internasional dengan fokus riset.',
            ],
            [
                'name' => 'HealthPlus',
                'category' => 'Healthcare',
                'description' => 'Layanan kesehatan modern dan digital.',
            ],
            [
                'name' => 'EcoFuture',
                'category' => 'Environment',
                'description' => 'Organisasi peduli lingkungan dan energi terbarukan.',
            ],
            [
                'name' => 'Creative Media Labs',
                'category' => 'Media',
                'description' => 'Studio kreatif untuk produksi media dan digital branding.',
            ],
        ]);

        $partners = $partners->map(function ($data) {
            return Partner::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'category' => $data['category'],
                'description' => $data['description'],
                'logo' => null,
            ]);
        });

        // 2) Seed 5 partner activities
        foreach ($partners as $partner) {
            for ($i = 1; $i <= 1; $i++) { // 1 activity per partner
                $title = $partner->name . " Activity Example";

                $activity = PartnerActivity::create([
                    'partner_id' => $partner->id,
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . strtolower(Str::random(4)),
                    'short_description' => 'Kegiatan kolaborasi strategis dengan ' . $partner->name,
                    'full_description' => 'Deskripsi lengkap mengenai aktivitas yang dilakukan dengan ' . $partner->name,
                    'activity_date' => now()->subDays(rand(5, 60))->format('Y-m-d'),
                    'featured_image' => null,
                ]);

                // 3) Seed photos for each activity (2 photos per activity)
                for ($p = 1; $p <= 2; $p++) {
                    PhotoActivity::create([
                        'activity_id' => $activity->id,
                        'image_path' => 'partner_activities/photos/sample-' . rand(1, 5) . '.jpg'
                    ]);
                }
            }
        }
    }
}

