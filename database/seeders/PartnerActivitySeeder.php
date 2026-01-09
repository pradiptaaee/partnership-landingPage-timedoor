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
        $activities = [
            'STMIK Primakara' => [
                [
                    'title' => 'Seminar Digital Innovation for Students',
                    'category_activity' => 'seminar',
                    'short_description' => 'Seminar pengenalan inovasi digital dan peluang karier teknologi.',
                    'full_description' => 'Kegiatan seminar yang membahas tren teknologi digital, startup, dan pengembangan skill mahasiswa.',
                ],
            ],

            'Universitas Muhammadiyah Surakarta' => [
                [
                    'title' => 'Workshop Pengenalan Coding untuk Mahasiswa',
                    'category_activity' => 'workshop',
                    'full_description' => 'Workshop interaktif mengenai dasar pemrograman dan logika komputasi.',
                ],
            ],

            'Sekolah Pelita Harapan' => [
                [
                    'title' => 'Coding Class for High School Students',
                    'category_activity' => 'kelas',
                    'full_description' => 'Kelas pengenalan coding untuk siswa SMA dengan metode praktik langsung.',
                ],
            ],

            'Education Plus School' => [
                [
                    'title' => 'Technology Day at Education Plus',
                    'category_activity' => 'event',
                    'full_description' => 'Kegiatan pengenalan teknologi dan kreativitas digital untuk siswa.',
                ],
            ],

            'Blue Dolphin Playskool' => [
                [
                    'title' => 'Fun Coding for Kids',
                    'category_activity' => 'kelas',
                    'full_description' => 'Kegiatan belajar logika dan kreativitas digital untuk anak usia dini.',
                ],
            ],

            'Taruwinara School' => [
                [
                    'title' => 'Creative Digital Workshop',
                    'category_activity' => 'workshop',
                    'full_description' => 'Workshop pengembangan kreativitas digital bagi siswa.',
                ],
            ],

            'SekolahApa.com' => [
                [
                    'title' => 'Kolaborasi Platform Edukasi Digital',
                    'category_activity' => 'kerjasama',
                    'full_description' => 'Kolaborasi pengembangan konten dan informasi edukasi digital.',
                ],
            ],

            'JJC Bali' => [
                [
                    'title' => 'Community Tech Sharing Session',
                    'category_activity' => 'seminar',
                    'short_description' => 'Sesi berbagi teknologi bersama komunitas JJC Bali.',
                    'full_description' => 'Diskusi dan sharing seputar teknologi, kreativitas, dan peluang digital.',
                ],
            ],

            'Finns Recreation Club' => [
                [
                    'title' => 'Kids Tech Camp Collaboration',
                    'category_activity' => 'event',
                    'full_description' => 'Kolaborasi event edukasi teknologi anak dalam suasana rekreasi.',
                ],
            ],
        ];

        foreach ($activities as $partnerName => $partnerActivities) {
            $partner = Partner::where('name', $partnerName)->first();

            if (!$partner)
                continue;

            foreach ($partnerActivities as $activity) {
                PartnerActivity::create([
                    'partner_id' => $partner->id,
                    'title' => $activity['title'],
                    'slug' => Str::slug($activity['title']),
                    'category_activity' => $activity['category_activity'],
                    'short_description' => $activity['short_description'] ?? null,
                    'full_description' => $activity['full_description'],
                    'activity_date' => now()->subDays(rand(10, 120)),
                ]);
            }
        }
    }
}
