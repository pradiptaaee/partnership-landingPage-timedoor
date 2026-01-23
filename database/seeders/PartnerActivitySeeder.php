<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\PartnerActivity;
use Illuminate\Support\Str;

class PartnerActivitySeeder extends Seeder
{
    public function run(): void
    {
         $partners = Partner::pluck('id');

        if ($partners->isEmpty()) {
            $this->command->warn('Seeder dihentikan: Tidak ada data partner.');
            return;
        }

        $activities = [
            [
                'title' => 'Seminar Literasi Digital',
                'category_activity' => 'seminar',
                'extra_attributes' => [
                    'speaker_name' => 'Dr. Andi Wijaya',
                    'speaker_photo' => 'activities/extra/speaker_andi.jpg',
                ],
            ],
            [
                'title' => 'Workshop Web Development Dasar',
                'category_activity' => 'workshop',
                'extra_attributes' => [
                    'mentor_name' => 'Budi Santoso',
                    'tools' => 'HTML, CSS, JavaScript',
                ],
            ],
            [
                'title' => 'Seminar Keamanan Siber',
                'category_activity' => 'seminar',
                'extra_attributes' => [
                    'speaker_name' => 'Rina Prameswari, M.Kom',
                    'speaker_photo' => 'activities/extra/speaker_rina.jpg',
                ],
            ],
            [
                'title' => 'Pelatihan Administrasi Digital',
                'category_activity' => 'pelatihan',
                'extra_attributes' => null, // kategori bebas tanpa extra field
            ],
            [
                'title' => 'Workshop UI/UX Design',
                'category_activity' => 'workshop',
                'extra_attributes' => [
                    'mentor_name' => 'Agus Pratama',
                    'tools' => 'Figma',
                ],
            ],
        ];

        foreach ($activities as $activity) {
            PartnerActivity::create([
                'partner_id' => $partners->random(),
                'title' => $activity['title'],
                'slug' => Str::slug($activity['title']) . '-' . Str::random(5),
                'category_activity' => $activity['category_activity'],
                'short_description' => 'Kegiatan kolaborasi bersama partner dalam rangka peningkatan kompetensi.',
                'full_description' => 'Kegiatan ini merupakan bagian dari program kerja sama yang bertujuan meningkatkan kapasitas dan pemahaman peserta melalui pendekatan praktis dan teoritis.',
                'activity_date' => now()->subDays(rand(1, 90)),
                'featured_image' => 'activities/featured/default.jpg',
                'extra_attributes' => $activity['extra_attributes'],
            ]);
            
        }
    }
}
