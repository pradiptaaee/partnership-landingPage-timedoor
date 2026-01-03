<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\StudentProject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. SEEDER BANNER (Hero Section)
        // ==========================================
        Banner::create([
            'image' => 'banners/hero-kids.jpg', // Pastikan file gambar ada di storage/app/public/banners
            'title' => [
                'en' => "Don't just let your child use technology",
                'id' => "Jangan biarkan anak hanya menggunakan teknologi",
                'ms' => "Jangan biarkan anak anda hanya menggunakan teknologi",
                'fil' => "Huwag hayaang gumamit lang ng teknolohiya ang iyong anak",
                'ja' => "子供にテクノロジーを使わせるだけでなく",
                'ar' => "لا تدع طفلك يستخدم التكنولوجيا فقط",
                'bn' => "আপনার সন্তানকে শুধু প্রযুক্তি ব্যবহার করতে দেবেন না"
            ],
            'description' => [
                'en' => "Teach them to invent it.",
                'id' => "Ajarkan mereka menciptakannya.",
                'ms' => "Ajar mereka merekaciptanya.",
                'fil' => "Turuan silang imbentuhin ito.",
                'ja' => "それを発明する方法を教えましょう。",
                'ar' => "علمهم كيف يبتكرونها.",
                'bn' => "তাদের এটি উদ্ভাবন করতে শেখান।"
            ]
        ]);

        // ==========================================
        // 2. SEEDER TESTIMONIAL
        // ==========================================
        Testimonial::create([
            'parent_name' => 'Sarah Jenkins', // Nama orang tidak perlu translate
            'parent_image' => 'testimonials/parent1.jpg',
            'student_name' => 'Mike, 10 y.o',
            'course_name'  => 'Game Development',
            'review' => [
                'en' => "My son loves coding now! Highly recommended.",
                'id' => "Anak saya sekarang suka coding! Sangat direkomendasikan.",
                'ms' => "Anak saya kini suka mengekod! Sangat disyorkan.",
                'fil' => "Mahilig na mag-coding ang anak ko ngayon! Highly recommended.",
                'ja' => "息子は今コーディングが大好きです！強くお勧めします。",
                'ar' => "ابني يحب البرمجة الآن! ينصح به بشده.",
                'bn' => "আমার ছেলে এখন কোডিং পছন্দ করে! অত্যন্ত বাঞ্ছনীয়।"
            ]
        ]);

        Testimonial::create([
            'parent_name' => 'Budi Pratama',
            'parent_image' => 'testimonials/parent2.jpg',
            'student_name' => 'Rio, 12 y.o',
            'course_name'  => 'Python AI',
            'review' => [
                'en' => "The curriculum is very structured and easy to understand.",
                'id' => "Kurikulumnya sangat terstruktur dan mudah dipahami.",
                'ms' => "Kurikulumnya sangat tersusun dan mudah difahami.",
                'fil' => "Ang kurikulum ay napaka-structured at madaling maunawaan.",
                'ja' => "カリキュラムは非常に体系的で理解しやすいです。",
                'ar' => "المنهج منظم للغاية وسهل الفهم.",
                'bn' => "পাঠ্যক্রমটি খুব কাঠামোগত এবং বোঝা সহজ।"
            ]
        ]);

        // ==========================================
        // 3. SEEDER STUDENT PROJECT
        // ==========================================
        StudentProject::create([
            'student_name' => 'Kevin Sanjaya',
            'project_image' => 'projects/roblox-game.jpg',
            'project_type' => [
                'en' => "Game Development",
                'id' => "Pengembangan Game",
                'ms' => "Pembangunan Permainan",
                'fil' => "Pagbuo ng Laro",
                'ja' => "ゲーム開発",
                'ar' => "تطوير الألعاب",
                'bn' => "গেম ডেভেলপমেন্ট"
            ]
        ]);

        StudentProject::create([
            'student_name' => 'Aisha Humaira',
            'project_image' => 'projects/website-porto.jpg',
            'project_type' => [
                'en' => "Website Building",
                'id' => "Pembuatan Website",
                'ms' => "Pembinaan Laman Web",
                'fil' => "Paggawa ng Website",
                'ja' => "ウェブサイト制作",
                'ar' => "إنشاء موقع إلكتروني",
                'bn' => "ওয়েবসাইট তৈরি"
            ]
        ]);
        
        StudentProject::create([
            'student_name' => 'Kenjiro',
            'project_image' => 'projects/ai-robot.jpg',
            'project_type' => [
                'en' => "Artificial Intelligence",
                'id' => "Kecerdasan Buatan (AI)",
                'ms' => "Kecerdasan Buatan",
                'fil' => "Artificial Intelligence",
                'ja' => "人工知能 (AI)",
                'ar' => "الذكاء الاصطناعي",
                'bn' => "কৃত্রিম বুদ্ধিমত্তা"
            ]
        ]);
    }
}