# 🚀 Timedoor Academy — Partnership Landing Page

Dokumentasi teknis lengkap untuk proyek **Landing Page & Fitur Partnership Timedoor Academy**, dibangun menggunakan **Laravel** dengan dukungan multi-bahasa, manajemen konten via Admin Panel, dan animasi modern.

---

## 📋 Daftar Isi

### Bagian 1 — Landing Page
- [Gambaran Umum](#gambaran-umum)
- [Tech Stack](#tech-stack)
- [Struktur Direktori](#struktur-direktori)
- [Cara Instalasi](#cara-instalasi)
- [Struktur Halaman Landing](#struktur-halaman-landing)
- [Sistem Multi-Bahasa](#sistem-multi-bahasa)
- [Routes](#routes)
- [Admin Panel Landing Page](#admin-panel-landing-page)
- [JavaScript & Animasi](#javascript--animasi)
- [Tracking & Analytics](#tracking--analytics)

### Bagian 2 — Fitur Partnership
- [Gambaran Umum Partnership](#gambaran-umum-partnership)
- [Struktur File Partnership](#struktur-file-partnership)
- [Database & Model](#database--model)
- [Halaman Publik Partnership](#halaman-publik-partnership)
- [Livewire: Activity Card](#livewire-activity-card)
- [Halaman Detail Kegiatan](#halaman-detail-kegiatan)
- [Admin Panel Partnership](#admin-panel-partnership)
- [Alur Kerja Partnership](#alur-kerja-partnership)
- [Penyimpanan File](#penyimpanan-file)

---

---

# 📄 BAGIAN 1 — LANDING PAGE

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

### Backend
| Teknologi | Versi | Keterangan |
|---|---|---|
| PHP | ^8.1 | Minimum versi PHP yang dibutuhkan |
| Laravel | ^10.0 | Framework utama (PHP) |
| Livewire | ^3.7 | Komponen interaktif tanpa halaman reload |
| Laravel Sanctum | ^3.2 | Autentikasi API |
| Spatie Permission | ^6.24 | Role & permission management |
| Spatie Translatable | ^6.11 | Dukungan konten multi-bahasa di model |
| Guzzle HTTP | ^7.2 | HTTP client (kirim data ke Google Sheets) |
| Google Translate PHP | ^5.3 | Terjemahan otomatis |
| Blade Icons | ^1.8 | Paket icon via Blade |

### Frontend
| Teknologi | Versi | Keterangan |
|---|---|---|
| Tailwind CSS | ^4.1.18 | Utility-first CSS framework |
| Vite | ^6.0.0 | Build tool & dev server |
| laravel-vite-plugin | ^1.0.0 | Integrasi Vite dengan Laravel |
| Swiper.js | ^12.0.3 | Slider/carousel (banner, testimoni, proyek) |
| intl-tel-input | ^26.4.1 | Input nomor telepon internasional (form trial) |
| Bootstrap Icons | ^1.13.1 | Ikon UI (digunakan di halaman partnership) |
| Tabler Icons | ^3.35.0 | Ikon UI tambahan |
| AOS | 2.3.1 (CDN) | Animate On Scroll — animasi saat scroll |
| Autoprefixer | ^10.4.23 | PostCSS plugin untuk kompatibilitas CSS |

### Tracking & Analytics
| Teknologi | Keterangan |
|---|---|
| Meta Pixel | Tracking konversi Facebook  |
| Microsoft Clarity | Rekaman sesi pengguna  |

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
| GET | `/partnership/{slug}` | `partnership.show` | Detail halaman kegiatan partner |

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

## Admin Panel Landing Page

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

---

# 🤝 BAGIAN 2 — FITUR PARTNERSHIP

---

## Gambaran Umum Partnership

Fitur Partnership memungkinkan Timedoor Academy untuk:
- Menampilkan **logo-logo partner** (sekolah, institusi) dalam slider infinite-scroll
- Memublikasikan **kegiatan bersama partner** (Workshop, Seminar, Pelatihan)
- Menyediakan halaman **detail kegiatan** lengkap dengan galeri foto
- Mengelola semua data tersebut melalui **Admin Panel**

---

## Struktur File Partnership

```
├── app/
│   ├── Http/Controllers/
│   │   ├── PartnerController.php              # Controller publik partnership
│   │   └── admin/
│   │       ├── PartnerAdminController.php     # Admin CRUD partner
│   │       └── PartnerActivityAdminController.php  # Admin CRUD kegiatan
│   └── Models/
│       ├── Partner.php                        # Model partner (sekolah/institusi)
│       ├── PartnerActivity.php                # Model kegiatan partner
│       ├── PhotoActivity.php                  # Model galeri foto kegiatan
│       ├── ActivitySeminarDetail.php          # Detail ekstra seminar
│       └── ActivityWorkshopDetail.php         # Detail ekstra workshop
├── resources/views/
│   ├── partners/
│   │   ├── index.blade.php                   # Halaman daftar partner & kegiatan
│   │   └── show.blade.php                    # Halaman detail kegiatan
│   └── livewire/
│       ├── partner-activity-card.blade.php   # Komponen Livewire kartu kegiatan
│       └── activity-gallery.blade.php        # Komponen Livewire galeri foto
```

---

## Database & Model

### Model: `Partner`

Merepresentasikan **sekolah atau institusi** yang bermitra dengan Timedoor.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `name` | string | Nama partner (unik) |
| `slug` | string | URL-friendly name (auto-generate) |
| `category` | string | Kategori partner (contoh: Sekolah, Perusahaan) |
| `description` | text | Deskripsi singkat |
| `logo` | string | Path file logo di storage |
| `email` | string (nullable) | Email kontak partner |
| `no_telepon` | string (nullable) | Nomor telepon partner |

**Relasi:**
- `activities()` → `hasMany(PartnerActivity)` — satu partner bisa punya banyak kegiatan
- Saat partner dihapus, **logo fisik dihapus otomatis** dari storage (via model event `deleting`)

---

### Model: `PartnerActivity`

Merepresentasikan **kegiatan** yang dilakukan bersama partner.

| Kolom | Tipe | Keterangan |
|---|---|---|
| `partner_id` | foreign key | Relasi ke tabel `partners` |
| `title` | string | Judul kegiatan |
| `slug` | string | Auto-generate dari title, unik |
| `category_activity` | string | Jenis: `seminar`, `workshop`, atau `pelatihan` |
| `full_description` | text | Deskripsi panjang kegiatan |
| `activity_date` | date | Tanggal pelaksanaan |
| `featured_image` | string (nullable) | Nama file gambar utama |

**Relasi:**
- `partner()` → `belongsTo(Partner)`
- `photos()` → `hasMany(PhotoActivity)`
- `seminarDetail()` → `hasOne(ActivitySeminarDetail)`
- `workshopDetail()` → `hasOne(ActivityWorkshopDetail)`

**Accessor:** `getFeaturedImageUrlAttribute()` → URL lengkap gambar utama dari `storage/activity/featured/`

**Model Events:** Saat kegiatan dihapus, featured image dan semua foto galeri otomatis terhapus dari storage.

---

### Model: `ActivitySeminarDetail`

Detail tambahan khusus untuk kegiatan bertipe **seminar**.

| Kolom | Keterangan |
|---|---|
| `partner_activity_id` | Foreign key ke `partner_activities` |
| `speaker_name` | Nama pembicara/narasumber |
| `speaker_about` | Bio singkat pembicara |
| `speaker_photo` | Nama file foto pembicara |

---

### Model: `ActivityWorkshopDetail`

Detail tambahan khusus untuk kegiatan bertipe **workshop**.

| Kolom | Keterangan |
|---|---|
| `partner_activity_id` | Foreign key ke `partner_activities` |
| `mentor_name` | Nama mentor workshop |
| `description` | Deskripsi singkat workshop |

---

### Model: `PhotoActivity`

Galeri foto untuk setiap kegiatan.

| Kolom | Keterangan |
|---|---|
| `partner_activity_id` | Foreign key ke `partner_activities` |
| `image_path` | Nama file foto di `storage/activity/photos/` |

---

## Halaman Publik Partnership

### Index Page — `/partnership`

**Controller:** `PartnerController::index()`  
**View:** `resources/views/partners/index.blade.php`

Halaman ini terdiri dari 3 bagian:

#### 1. Hero Section
- Judul halaman (dari `__('partnership.title')`)
- Gambar hero statis
- Dua paragraf intro dan link kontak

#### 2. Slider Logo Partner
- Slider **infinite scroll otomatis** (CSS animation `animate-scroll`)
- Data dari database: partner yang memiliki logo (`whereNotNull('logo')`)
- Logo di-duplicate (loop dua kali) untuk efek infinite tanpa jeda
- Hover: animasi pause & logo scale-up
- Gambar diakses via: `asset('storage/' . $partner->logo)`

#### 3. Daftar Kegiatan (Workshop Section)
- Background hijau muda `#EDFFF3`
- Menggunakan **Livewire component** `@livewire('partner-activity-card')`
- Fitur: pencarian, filter kategori & tahun, pagination (3 item per halaman)

---

## Livewire: Activity Card

**View:** `resources/views/livewire/partner-activity-card.blade.php`

Komponen Livewire yang menangani tampilan dan filter kegiatan secara **real-time tanpa reload halaman**.

| Fitur | Wire Property | Keterangan |
|---|---|---|
| **Pencarian** | `wire:model.live.debounce.300ms="search"` | Cari berdasarkan judul, debounce 300ms |
| **Filter Kategori** | `wire:model.live="category"` | Workshop / Seminar / Pelatihan |
| **Filter Tahun** | `wire:model.live="year"` | 2021 – 2025 |
| **Reset Filter** | `wire:click="resetFilters"` | Hapus semua filter |

Setiap kartu menampilkan: badge nama partner, gambar featured, tanggal, judul, cuplikan deskripsi, dan tombol **"Lihat Detail"**.

---

## Halaman Detail Kegiatan

**Route:** `GET /partnership/{slug}`  
**Controller:** `PartnerController::show($slug)`  
**View:** `resources/views/partners/show.blade.php`

### Struktur Halaman

1. **Hero Banner** — Gambar utama full-width, badge tanggal, judul kegiatan, tombol back
2. **Info Card (3 kolom)** — Tanggal · Email partner · No. Telepon partner
3. **Detail kondisional:**
   - **Jika Seminar** → Foto + profil pembicara (nama & bio)
   - **Jika Workshop** → Nama mentor & deskripsi
4. **Deskripsi Lengkap** — Full description dengan `nl2br` dan karakter di-escape
5. **Galeri Foto** — via `<livewire:activity-gallery :activity="$activity" />`
6. **Tombol Kembali** ke `/partnership`

---

## Admin Panel Partnership

> Semua route admin memerlukan **autentikasi** (`middleware: auth`).

### Manajemen Partner — `/admin/partners`

**Controller:** `PartnerAdminController`

| Method | URL | Keterangan |
|---|---|---|
| GET | `/admin/partners` | Daftar semua partner |
| GET | `/admin/partners/create` | Form tambah partner baru |
| POST | `/admin/partners` | Simpan partner baru |
| GET | `/admin/partners/{partner}` | Detail partner |
| GET | `/admin/partners/{partner}/edit` | Form edit partner |
| PUT | `/admin/partners/{partner}` | Update data partner |
| DELETE | `/admin/partners/{partner}` | Hapus partner + logo |

**Upload Logo:** Disimpan di `storage/public/partner/logo/`. Logo lama otomatis dihapus saat update/delete.

---

### Manajemen Kegiatan — `/admin/activity`

**Controller:** `PartnerActivityAdminController`

| Method | URL | Keterangan |
|---|---|---|
| GET | `/admin/activity` | Daftar kegiatan (paginate 6) |
| GET | `/admin/activity/create` | Form tambah kegiatan |
| POST | `/admin/activity` | Simpan kegiatan baru |
| GET | `/admin/activity/{slug}` | Detail kegiatan (admin) |
| GET | `/admin/activity/{id}/edit` | Form edit kegiatan |
| PUT | `/admin/activity/{id}` | Update data kegiatan |
| DELETE | `/admin/activity/{id}` | Hapus kegiatan + semua foto |
| DELETE | `/admin/activity/photo/{photo}` | Hapus satu foto galeri |

#### Validasi Input

Field umum: `partner_id`, `title`, `category_activity`, `full_description`, `activity_date`, `featured_image` (max 2MB), `photos.*` (max 2MB).

Field tambahan **jika Seminar**: `speaker_name` (required), `speaker_about` (required), `speaker_photo` (required saat create, nullable saat edit).

Field tambahan **jika Workshop**: `mentor_name` (required), `description` (required, max 255).

#### Proses Penyimpanan (Database Transaction)

```
1. Validasi input
2. BEGIN TRANSACTION
   ├── Simpan/update data PartnerActivity
   ├── Simpan/update detail (seminarDetail atau workshopDetail)
   └── Upload foto galeri (jika ada)
3. COMMIT / ROLLBACK jika error
```

**Slug Auto-Generate:** Dibuat dari `title` via `Str::slug()`. Jika duplikat, ditambah counter: `judul-1`, `judul-2`, dst.

---

## Alur Kerja Partnership

```
[Admin]
  ├── Tambah Partner → logo disimpan di storage/partner/logo/
  └── Tambah Kegiatan
        ├── Pilih Partner + isi data umum
        ├── Upload featured image → storage/activity/featured/
        ├── [Seminar] Data pembicara + foto → storage/activity/speakers/
        ├── [Workshop] Data mentor
        └── Upload foto galeri → storage/activity/photos/

[Pengguna Publik]
  ├── Buka /partnership
  │     ├── Slider logo partner (infinite scroll)
  │     ├── Filter kegiatan (cari / kategori / tahun)
  │     └── Klik kartu → /partnership/{slug}
  └── Detail kegiatan
        ├── Hero image + info dasar
        ├── Detail pembicara / mentor (kondisional)
        ├── Deskripsi lengkap
        └── Galeri foto
```

---

## Penyimpanan File

| Jenis File | Path di Storage | Cara Akses |
|---|---|---|
| Logo partner | `storage/partner/logo/` | `asset('storage/partner/logo/file.jpg')` |
| Gambar utama kegiatan | `storage/activity/featured/` | `$activity->featured_image_url` (accessor) |
| Foto pembicara seminar | `storage/activity/speakers/` | `asset('storage/activity/speakers/file.jpg')` |
| Foto galeri kegiatan | `storage/activity/photos/` | via relasi `$activity->photos` |

> **Pastikan storage link aktif:**
> ```bash
> php artisan storage:link
> ```

---

*Dikembangkan oleh Tim Timedoor Academy — Intern Magang Batch 2025*
