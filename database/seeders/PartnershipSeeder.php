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
                'name' => 'STMIK Primakara',
                'category' => 'Kampus',
                'description' => 'Perguruan tinggi di bidang teknologi dan bisnis digital.',
            ],
            [
                'name' => 'Universitas Muhammadiyah Surakarta',
                'category' => 'Kampus',
                'description' => 'Universitas swasta dengan fokus pengembangan akademik dan teknologi.',
            ],
            [
                'name' => 'Sekolah Pelita Harapan',
                'category' => 'Sekolah',
                'description' => 'Sekolah nasional-plus dengan kurikulum internasional.',
            ],
            [
                'name' => 'Education Plus School',
                'category' => 'Sekolah',
                'description' => 'Sekolah dengan pendekatan pembelajaran kreatif dan modern.',
            ],
            [
                'name' => 'Blue Dolphin Playskool',
                'category' => 'Sekolah',
                'description' => 'Pendidikan anak usia dini dengan metode bermain edukatif.',
            ],
            [
                'name' => 'Taruwinara School',
                'category' => 'Sekolah',
                'description' => 'Sekolah berbasis karakter dan pengembangan potensi siswa.',
            ],
            [
                'name' => 'SekolahApa.com',
                'category' => 'Platform Edukasi',
                'description' => 'Platform informasi dan kolaborasi pendidikan di Indonesia.',
            ],
            [
                'name' => 'JJC Bali',
                'category' => 'Komunitas',
                'description' => 'Komunitas pengembangan bakat dan kreativitas anak muda.',
            ],
            [
                'name' => 'Finns Recreation Club',
                'category' => 'Corporate',
                'description' => 'Pusat rekreasi dan olahraga keluarga di Bali.',
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

