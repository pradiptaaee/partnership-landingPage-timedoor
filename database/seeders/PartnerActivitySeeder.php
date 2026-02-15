<?php

namespace Database\Seeders;

use App\Models\ActivitySeminarDetail;
use App\Models\ActivityWorkshopDetail;
use App\Models\PhotoActivity;
use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\PartnerActivity;
use Illuminate\Support\Str;

class PartnerActivitySeeder extends Seeder
{
    public function run(): void
    {
         $partners = Partner::inRandomOrder()->take(5)->get();

        $activities = [
            [
                'type' => 'seminar',
                'title' => 'Seminar Transformasi Digital Pendidikan',
                
                'full_description' => 'Seminar ini bertujuan memberikan wawasan kepada pendidik dan mahasiswa mengenai pemanfaatan teknologi digital, sistem pembelajaran modern, serta tantangan transformasi digital di institusi pendidikan.',
                'speaker_name' => 'Dr. Andi Prasetyo',
                'speaker_about' => 'Akademisi dan praktisi transformasi digital pendidikan.',
                'speaker_photo' => 'speakers/andi-prasetyo.jpg',
            ],
            [
                'type' => 'workshop',
                'title' => 'Workshop UI/UX Design Fundamental',
                
                'full_description' => 'Workshop ini dirancang untuk pemula yang ingin memahami proses UI/UX Design mulai dari user research, wireframe, hingga prototype menggunakan tools industri.',
                'mentor_name' => 'Rizky Mahendra',
                'mentor_description' => 'Senior UI/UX Designer dengan pengalaman di startup teknologi.',
            ],
            [
                'type' => 'seminar',
                'title' => 'Seminar Karier IT di Era Industri 5.0',
                
                'full_description' => 'Seminar ini membahas peluang karier di bidang IT, skill yang dibutuhkan industri, serta tips membangun portofolio dan personal branding.',
                'speaker_name' => 'Dewi Lestari, M.Kom',
                'speaker_about' => 'Konsultan karier IT dan dosen sistem informasi.',
                'speaker_photo' => 'speakers/dewi-lestari.jpg',
            ],
            [
                'type' => 'workshop',
                'title' => 'Workshop Laravel Web Development',
                
                'full_description' => 'Peserta akan mempelajari dasar Laravel hingga implementasi CRUD, relasi database, dan autentikasi sederhana.',
                'mentor_name' => 'Fajar Nugroho',
                'mentor_description' => 'Fullstack Web Developer & mentor bootcamp.',
            ],
            [
                'type' => 'seminar',
                'title' => 'Seminar Pemanfaatan AI untuk Pendidikan',
                
                'full_description' => 'Seminar ini mengulas penerapan Artificial Intelligence dalam personalisasi pembelajaran, otomasi administrasi, serta tantangan etika penggunaan AI di dunia pendidikan.',
                'speaker_name' => 'Prof. Budi Santoso',
                'speaker_about' => 'Peneliti dan akademisi bidang Artificial Intelligence.',
                'speaker_photo' => 'speakers/budi-santoso.jpg',
            ],
        ];

        foreach ($partners as $index => $partner) {
            $data = $activities[$index];

            // 1️⃣ Partner Activity
            $activity = PartnerActivity::create([
                'partner_id' => $partner->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . Str::random(5),
                'category_activity' => $data['type'],
                
                'full_description' => $data['full_description'],
                'activity_date' => now()->addDays(rand(10, 60)),
                'featured_image' => 'partner_activities/featured/cover-' . ($index + 1) . '.jpg',
            ]);

            // 2️⃣ Detail berdasarkan kategori
            if ($data['type'] === 'seminar') {
                ActivitySeminarDetail::create([
                    'partner_activity_id' => $activity->id,
                    'speaker_name' => $data['speaker_name'],
                    'speaker_about' => $data['speaker_about'],
                    'speaker_photo' => $data['speaker_photo'],
                ]);
            }

            if ($data['type'] === 'workshop') {
                ActivityWorkshopDetail::create([
                    'partner_activity_id' => $activity->id,
                    'mentor_name' => $data['mentor_name'],
                    'description' => $data['mentor_description'],
                ]);
            }

            // 3️⃣ Gallery Photos
            for ($i = 1; $i <= 3; $i++) {
                PhotoActivity::create([
                    'partner_activity_id' => $activity->id,
                    'image_path' => 'partner_activities/gallery/sample-' . rand(1, 6) . '.jpg',
                ]);
            }
        }
    }
}