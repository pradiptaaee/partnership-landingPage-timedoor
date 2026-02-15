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
        $partners = collect([
            [
                'name' => 'STMIK Primakara',
                'category' => 'Kampus',
                'description' => 'Perguruan tinggi di bidang teknologi dan bisnis digital.',
                'email' => 'info@primakara.ac.id',
                'no_telepon' => '0361222555',
            ],
            [
                'name' => 'Universitas Muhammadiyah Surakarta',
                'category' => 'Kampus',
                'description' => 'Universitas swasta dengan fokus pengembangan akademik dan teknologi.',
                'email' => 'info@ums.ac.id',
                'no_telepon' => '0271717111',
            ],
            [
                'name' => 'Sekolah Pelita Harapan',
                'category' => 'Sekolah',
                'description' => 'Sekolah nasional-plus dengan kurikulum internasional.',
                'email' => 'info@uph.edu',
                'no_telepon' => '0215460901',
            ],
            [
                'name' => 'Education Plus School',
                'category' => 'Sekolah',
                'description' => 'Sekolah dengan pendekatan pembelajaran kreatif dan modern.',
                'email' => 'contact@educationplus.sch.id',
                'no_telepon' => '0361467890',
            ],
            [
                'name' => 'Blue Dolphin Playskool',
                'category' => 'Sekolah',
                'description' => 'Pendidikan anak usia dini dengan metode bermain edukatif.',
                'email' => 'admin@bluedolphinplayskool.sch.id',
                'no_telepon' => '081234567890',
            ],
            [
                'name' => 'Taruwinara School',
                'category' => 'Sekolah',
                'description' => 'Sekolah berbasis karakter dan pengembangan potensi siswa.',
                'email' => 'info@taruwinara.sch.id',
                'no_telepon' => '0361223344',
            ],
            [
                'name' => 'SekolahApa.com',
                'category' => 'Platform Edukasi',
                'description' => 'Platform informasi dan kolaborasi pendidikan di Indonesia.',
                'email' => 'support@sekolahapa.com',
                'no_telepon' => '082145678901',
            ],
            [
                'name' => 'JJC Bali',
                'category' => 'Komunitas',
                'description' => 'Komunitas pengembangan bakat dan kreativitas anak muda.',
                'email' => 'contact@jjcbali.org',
                'no_telepon' => '081987654321',
            ],
            [
                'name' => 'Finns Recreation Club',
                'category' => 'Corporate',
                'description' => 'Pusat rekreasi dan olahraga keluarga di Bali.',
                'email' => 'info@finnsrecclub.com',
                'no_telepon' => '0361848900',
            ],
        ]);

        $partners = $partners->map(function ($data) {
            return Partner::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'category' => $data['category'],
                'description' => $data['description'],
                'email' => $data['email'],
                'no_telepon' => $data['no_telepon'],
                'logo' => null,
            ]);
        });

        foreach ($partners as $partner) {
            $title = $partner->name . ' Activity Example';

            $activity = PartnerActivity::create([
                'partner_id' => $partner->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . strtolower(Str::random(4)),
                
                'full_description' => 'Deskripsi lengkap mengenai aktivitas yang dilakukan dengan ' . $partner->name,
                'activity_date' => now()->subDays(rand(5, 60))->format('Y-m-d'),
                'featured_image' => null,
            ]);

            for ($p = 1; $p <= 2; $p++) {
                PhotoActivity::create([
                    'activity_id' => $activity->id,
                    'image_path' => 'partner_activities/photos/sample-' . rand(1, 5) . '.jpg',
                ]);
            }
        }
    }

}

