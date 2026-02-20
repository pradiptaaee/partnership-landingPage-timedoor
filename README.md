# 🚀 Timedoor Academy — Partnership Landing Page





#  DOKUMENTASI UNTUK LANDING PAGE
Dokumentasi teknis untuk proyek **Landing Page Partnership Timedoor Academy**, dibangun menggunakan **Laravel** dengan dukungan multi-bahasa, manajemen konten via Admin Panel, dan animasi modern.

---

## 📋 Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Tech Stack](#tech-stack)
- [Struktur Direktori](#struktur-direktori)
- [Cara Instalasi](#cara-instalasi)
- [Struktur Halaman Landing](#struktur-halaman-landing)
- [Sistem Multi-Bahasa](#sistem-multi-bahasa)
- [Routes](#routes)
- [Admin Panel](#admin-panel)
- [JavaScript & Animasi](#javascript--animasi)
- [Tracking & Analytics](#tracking--analytics)

---

## Gambaran Umum

Landing page ini berfungsi sebagai halaman utama pemasaran untuk **Program Partnership Timedoor Academy** — akademi coding anak-anak yang beroperasi di berbagai negara (Indonesia, Malaysia, Filipina, Bangladesh, Jepang, Arab, dll).

**Fitur Utama:**
- ✅ Multi-bahasa (7 bahasa: ID, EN, JP, AR, BD, PH, MY)
- ✅ Navbar dinamis (berubah warna saat melewati section hijau)
- ✅ Konten dinamis dari database (banner, testimonial, proyek siswa, hero image)
- ✅ Slider otomatis (Swiper.js)
- ✅ Animasi scroll (AOS)
- ✅ Formulir pendaftaran Free Trial terintegrasi
- ✅ Admin panel untuk manajemen konten

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| Framework | Laravel (PHP) |
| Templating | Blade |
| CSS | Custom CSS + Tailwind utility classes |
| Build Tool | Vite |
| Animation | [AOS (Animate On Scroll)](https://michalsnik.github.io/aos/) |
| Slider | [Swiper.js v11](https://swiperjs.com/) |
| Phone Input | [intl-tel-input v24](https://intl-tel-input.com/) |
| Font | Google Fonts — Poppins |
| Tracking | Meta Pixel, Microsoft Clarity |

---

## Struktur Direktori

```
├── resources/
│   ├── views/
│   │   └── landing_page/
│   │       ├── layouts/
│   │       │   └── app.blade.php          # Layout utama (navbar, footer)
│   │       ├── sections/
│   │       │   ├── hero.blade.php          # Section 1: Hero banner
│   │       │   ├── proof.blade.php         # Section 2: Banner & Testimoni
│   │       │   ├── product_knowledge.blade.php  # Section 3.1: USP
│   │       │   ├── output_proof.blade.php  # Section 3.2: Proyek Siswa
│   │       │   └── cta_promo.blade.php     # Section 4: CTA & Statistik
│   │       ├── form/                       # Form Free Trial
│   │       └── index.blade.php             # Entry point halaman
│   ├── js/
│   │   └── landing_page/
│   │       ├── app.js                      # JS utama (navbar, dropdown, swiper)
│   │       └── trial.js                    # JS khusus form trial
│   └── css/
│       └── landing/
│           └── app.css                     # CSS landing page
├── lang/
│   ├── id.json                             # Bahasa Indonesia
│   ├── en.json                             # Bahasa Inggris
│   ├── ja.json                             # Bahasa Jepang
│   ├── ar.json                             # Bahasa Arab
│   ├── bn.json                             # Bahasa Bangladesh
│   ├── fil.json                            # Bahasa Filipina
│   └── ms.json                             # Bahasa Melayu
└── routes/
    └── web.php                             # Definisi semua route
```

---

## Cara Instalasi

```bash
# 1. Clone repositori
git clone <repo-url>
cd partnership-landingPage-timedoor

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node.js
npm install

# 4. Salin dan konfigurasi environment
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi database di .env, lalu jalankan migrasi
php artisan migrate --seed

# 6. Build assets (mode development)
npm run dev

# 7. Jalankan server Laravel
php artisan serve
```

> **Catatan:** Pastikan storage sudah di-link agar gambar tampil dengan benar.
> ```bash
> php artisan storage:link
> ```

---

## Struktur Halaman Landing

Halaman utama (`/`) terdiri dari 5 section yang di-include secara berurutan:

### Section 1 — Hero (`hero.blade.php`)
- Menampilkan **judul, subjudul, dan deskripsi** yang diambil dari file bahasa
- **Hero image** dinamis dari database (dikelola via Admin → Hero)
- Tombol CTA "Book a Free Trial" yang mengarah ke `/book-free-trial`
- Data hero image dikirim dari `LandingPageController::index()`

### Section 2 — Proof (`proof.blade.php`)
- **Slider Banner** (kiri ke kanan, auto-scroll tanpa henti): menampilkan pencapaian/penghargaan dari database
- **Slider Testimoni** (auto-scroll kanan ke kiri): menampilkan review orang tua siswa
- Jika database kosong, tampilkan konten *fallback* statis
- Menggunakan Swiper.js dengan mode `loop` dan `autoplay`

### Section 3.1 — Product Knowledge (`product_knowledge.blade.php`)
- Menampilkan **3 USP (Unique Selling Points)** Timedoor Academy:
  1. Small Classes, Big Impact (maks. 5 siswa)
  2. Proprietary Gamified Rewards (sistem koin)
  3. Future-Proof Skills (Game, Web, App, AI)
- Teks menggunakan sistem terjemahan `__('key')`

### Section 3.2 — Output Proof (`output_proof.blade.php`)
- **Slider Proyek Siswa** dengan tombol navigasi prev/next
- Setiap slide menampilkan gambar proyek siswa beserta nama, usia, dan tipe proyek
- Info siswa diperbarui secara dinamis saat slide berubah (via JavaScript)
- Data dari model `StudentProject` di database

### Section 4 — CTA & Promo (`cta_promo.blade.php`)
- Judul besar ajakan bergabung (supports HTML via `{!! __('key') !!}`)
- **3 Kotak Statistik**: jumlah siswa, kompetisi, modul
- **2 Tombol CTA**: Cek Harga & Book Free Trial

---

## Sistem Multi-Bahasa

Proyek ini mendukung **7 bahasa** menggunakan sistem terjemahan Laravel berbasis JSON.

### Bahasa yang Tersedia

| Kode Display | Locale Laravel | File |
|---|---|---|
| ID | `id` | `lang/id.json` |
| EN | `en` | `lang/en.json` |
| JP | `ja` | `lang/ja.json` |
| AR | `ar` | `lang/ar.json` |
| BD | `bn` | `lang/bn.json` |
| PH | `fil` | `lang/fil.json` |
| MY | `ms` | `lang/ms.json` |

### Cara Kerja

1. User memilih bahasa dari **dropdown navbar** (ikon bendera)
2. Klik memicu redirect ke route `/lang/{locale}` (contoh: `/lang/en`)
3. `LandingPageController::changeLanguage()` menyimpan locale ke **session** dan cookie
4. Halaman di-reload dengan locale baru, semua teks `__('key')` otomatis berganti
5. Untuk bahasa **Arab (RTL)**, atribut `dir="rtl"` ditambahkan otomatis di tag `<html>`

### Menambah Kunci Terjemahan Baru

Tambahkan kunci yang sama di **semua 7 file JSON**:

```json
// lang/id.json
"Kunci Baru": "Teks dalam Bahasa Indonesia"

// lang/en.json  
"Kunci Baru": "Text in English"
```

Gunakan di Blade:
```blade
{{ __('Kunci Baru') }}
```

---

## Routes

### Public Routes

| Method | URL | Nama Route | Keterangan |
|---|---|---|---|
| GET | `/` | `landing` | Halaman utama landing page |
| GET | `/book-free-trial` | `trial.index` | Form pendaftaran kelas trial |
| POST | `/book-free-trial` | `landing.book-trial.store` | Kirim data pendaftaran |
| GET | `/lang/{locale}` | `change.language` | Ganti bahasa aktif |
| GET | `/partnership` | `partnership.index` | Halaman daftar partner |
| GET | `/partnership/{slug}` | `partnership.show` | Detail halaman partner |

### Admin Routes (requires auth)

Semua route admin diawali `/admin` dan memerlukan login:

| URL | Keterangan |
|---|---|
| `/admin/dashboard` | Dashboard admin |
| `/admin/landing-page/banners` | CRUD banner slider |
| `/admin/landing-page/testimonials` | CRUD testimonial |
| `/admin/landing-page/projects` | CRUD proyek siswa |
| `/admin/landing-page/hero` | Edit hero image per bahasa |
| `/admin/landing-page/free-trials` | Lihat & hapus data pendaftar trial |
| `/admin/partners` | CRUD data partner |
| `/admin/activity` | CRUD aktivitas partner |

### Authentication

| Method | URL | Keterangan |
|---|---|---|
| GET | `/login` | Halaman login admin |
| POST | `/login` | Proses login |
| POST | `/logout` | Logout |

---

## Admin Panel

Admin dapat mengelola semua konten landing page secara dinamis tanpa mengubah kode:

### 🖼️ Hero Management
- **Path:** `/admin/landing-page/hero`
- Upload gambar hero yang berbeda untuk setiap bahasa
- Preview tampilan hero sebelum publish

### 📢 Banner Management
- **Path:** `/admin/landing-page/banners`
- CRUD banner yang ditampilkan di slider Section 2
- Setiap banner memiliki judul (multi-bahasa) dan gambar

### 💬 Testimonial Management
- **Path:** `/admin/landing-page/testimonials`
- CRUD testimoni orang tua siswa
- Field: foto orang tua, nama orang tua, nama siswa, nama kursus, isi review (multi-bahasa)

### 🎨 Student Project Management
- **Path:** `/admin/landing-page/projects`
- CRUD proyek karya siswa untuk ditampilkan di slider Section 3.2
- Field: nama siswa, usia, tipe proyek, gambar proyek

### 📋 Free Trial Data
- **Path:** `/admin/landing-page/free-trials`
- Lihat semua data pendaftar kelas trial
- Dapat menghapus data

---

## JavaScript & Animasi

### `resources/js/landing_page/app.js`

File utama berisi 3 modul:

**1. Language Dropdown**
- Membuka/menutup dropdown pilihan bahasa di navbar
- Menyembunyikan bahasa yang sedang aktif dari daftar
- Redirect ke `/lang/{locale}` saat bahasa dipilih
- Peta kode: `ID→id`, `EN→en`, `BD→bn`, `AR→ar`, `PH→fil`, `JP→ja`, `MY→ms`

**2. Dynamic Navbar**
- Navbar berwarna putih secara default
- Berubah menjadi **hijau** (`#10AF13`) saat scroll melewati section yang memiliki class `.bg-green-trigger`
- Logo, warna tombol, dan dropdown ikut berubah menyesuaikan background

**3. Swiper.js Sliders**

| Instance | Selector | Arah | Kecepatan | Keterangan |
|---|---|---|---|---|
| `swiper_left` | `.swiper_left` | Kiri | 5000ms (linear, no pause) | Banner achievements |
| `swiper_right` | `.swiper_right` | Kanan | 800ms, delay 3s | Testimonial |
| `project_swiper` | `.project_swiper` | Auto | delay 3.5s | Proyek siswa + update info |

### AOS (Animate On Scroll)
Semua elemen penting menggunakan animasi `data-aos="fade-up"` dengan delay bertahap untuk efek cascade:
```html
<div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
```
AOS diinisialisasi di akhir `app.blade.php`:
```html
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
```

---

## Tracking & Analytics

Dua tool tracking terintegrasi di `layouts/app.blade.php`:

### Meta Pixel (Facebook)
- **Pixel ID:** `1400928094715921`
- Event yang di-track: `PageView` (otomatis)

### Microsoft Clarity
- **Tag ID:** `vj2kxeea7l`
- Merekam sesi pengguna untuk analisis UX

---

## Footer

Footer terdiri dari 3 blok:
1. **CTA Banner** — Ajakan "Try Free Class" dengan tombol (tersembunyi di halaman trial)
2. **Cabang Internasional** — Kontak admin per negara (ID, MY, PH, EG, JP, SY, BD, US)
3. **Footer Utama** — Link navigasi, daftar kursus, partnership, sosial media, dan pilihan bahasa teks

---

*Dikembangkan oleh Tim Timedoor Academy — Intern Magang Batch 2025*
