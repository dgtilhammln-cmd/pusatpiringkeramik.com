# HVM Digital — Website Company Profile

> Platform website company profile berbasis **Laravel 11** dengan sistem manajemen konten, tracking leads WhatsApp, SEO otomatis, dan panel admin premium.

**Developer:** Ilhammaulana | HVM Digital  
**Versi:** 2.0.0  
**Tech Stack:** Laravel 11 · PHP 8.2+ · MySQL · Vanilla CSS · Vanilla JS  

---

## 🚀 Fitur Utama

### 1. Desain Premium & Responsif
- **Clean Modern UI:** Panel admin & frontend menggunakan desain bersih minimalis dengan warna dominan putih dan aksen biru.
- **Tipografi Modern:** Perpaduan *Plus Jakarta Sans* dan *Montserrat* yang profesional dan mudah dibaca.
- **Micro-Animations:** Transisi halus pada setiap *hover* elemen, tombol, navigasi, dan loading screen.
- **Dynamic Theming:** Tema warna utama, warna aksen, dan background hero dikelola langsung dari panel admin.
- **Mobile-First Responsive:** Seluruh halaman dioptimalkan untuk tampilan di HP, tablet, dan desktop.

### 2. Panel Admin Premium
- **Dashboard Analitik Real-time:** Melacak pengunjung, Leads WhatsApp, dan CTR berdasarkan filter tanggal.
- **Pusat Notifikasi:** Dropdown notifikasi leads baru bergaya "Notification Center" dengan tab Hari Ini / Minggu Ini / Sebelumnya.
- **Rich Text Editor:** Editor konten terintegrasi dengan fitur upload gambar native (format WebP, tanpa plugin).
- **CRUD Lengkap:** Artikel, Layanan (Produk), Galeri, Klien, dan Pengaturan.
- **Loading Screen Premium:** Animasi loading saat login/logout dengan logo melayang (bounce) dan progress bar biru.
- **Gallery Create/Edit:** Form galeri dengan card layout putih elegan, field focus biru, dan ikon informatif.

### 3. Sistem Tracking WhatsApp (Lead Interceptor)
- **Event Interceptor Pintar:** Semua klik WhatsApp di seluruh halaman dicegat secara otomatis.
- **Pop-up Form Leads:** Pengunjung mengisi form mini sebelum diarahkan ke WhatsApp.
- **Pelacakan Sumber:** Data UTM (`utm_source`, `utm_medium`, `utm_campaign`) otomatis tersimpan di setiap Lead.
- **Status & Catatan:** Admin bisa update status Lead (Baru → Dihubungi → Selesai) dan tambah catatan follow-up.
- **Export PDF:** Data leads bisa diekspor untuk laporan tim Sales.

### 4. SEO Tingkat Lanjut
- **JSON-LD Schema:** Structured data otomatis untuk Produk (Product Schema), Artikel, dan **FAQ Page**.
- **Meta Tags Dinamis:** Open Graph, Twitter Cards, dan Canonical URL dikelola dari admin.
- **Sitemap & llms.txt:** File sitemap XML dan llms.txt tersedia untuk SEO teknis.
- **Kompresi WebP:** Gambar yang diupload otomatis dikompres ke format WebP.
- **FAQ Persuasif:** Section FAQ terstruktur di halaman produk dengan tampilan tabel selaras dengan Spesifikasi.

### 5. Footer & Navigasi
- **Footer Seragam:** Warna footer menyatu dengan breadcrumb (#F8FAFC), tanpa warna merah, ikon sosial hover biru.
- **Breadcrumb Konsisten:** Tampil di semua halaman inner dengan skema warna yang sama.
- **Watermark Developer:** Link hvmdigital.id mengarah ke halaman jasa pembuatan website.

---

## 🛠 Teknologi yang Digunakan

| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Database** | MySQL / SQLite (konfigurasi via `.env`) |
| **Frontend Engine** | Blade Templating |
| **Styling** | Vanilla CSS (CSS Custom Properties) |
| **JavaScript** | Vanilla JS ES6 + AJAX Fetch API |
| **Slider** | Swiper.js v11 |
| **Image Processing** | PHP GD Library (konversi ke WebP) |
| **Alert/Popup** | SweetAlert2 |

---

## 📁 Struktur Penting

```
├── app/
│   ├── Http/Controllers/     ← Semua controller
│   └── Models/               ← Model Eloquent
├── database/seeders/         ← Seeder data awal (admin, settings)
├── resources/views/
│   ├── admin/                ← Semua halaman panel admin
│   ├── layouts/              ← Layout utama (admin.blade.php, app.blade.php)
│   ├── components/           ← Header, footer, navbar
│   └── services/show.blade.php ← Halaman detail produk
├── public/                   ← Asset publik (di-upload ke public_html)
├── storage/app/public/       ← File upload (gambar, dokumen)
├── CLONE.md                  ← Panduan kloning & re-deployment lengkap
└── .env                      ← Konfigurasi (JANGAN di-commit ke Git)
```

---

## ⚡ Instalasi Lokal (Development)

```bash
# 1. Clone repository
git clone https://github.com/username/nama-repo.git
cd nama-repo

# 2. Install dependensi PHP
composer install

# 3. Salin & konfigurasi environment
cp .env.example .env
# Edit .env: isi DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Generate app key
php artisan key:generate

# 5. Migrasi database & seeding
php artisan migrate:fresh --seed

# 6. Link storage
php artisan storage:link

# 7. Jalankan server lokal
php artisan serve
```

Buka `http://localhost:8000` di browser. Login admin di `/admin/login`.

---

## 🚢 Deploy ke Hostinger

Gunakan metode **pemisahan `core-web` dan `public_html`** untuk keamanan maksimal.
Lihat panduan lengkap di **[CLONE.md](./CLONE.md)** → Tahap 9.

```
server/
├── core-web/      ← Semua file Laravel (.env AMAN di sini)
└── public_html/   ← Hanya isi folder /public
```

---

## 🔐 Keamanan

- ✅ Proteksi CSRF (`@csrf` di semua form)
- ✅ Escaping XSS otomatis (`{{ }}` Blade)
- ✅ Validasi server-side di setiap request
- ✅ Middleware `auth` melindungi seluruh route admin
- ✅ `.env` diabaikan Git (tidak pernah terupload)

---

## 📦 Git Workflow

```bash
# Commit & push perubahan baru
git add .
git commit -m "feat: deskripsi perubahan"
git push
```

---

## 📞 Hubungi Pengembang

Butuh modifikasi, instalasi, atau fitur tambahan?

**Ilhammaulana | HVM Digital**  
🌐 Website: [hvmdigital.id](https://hvmdigital.id/jasa-pembuatan-website-jakarta-murah)  
💬 WhatsApp: Tersedia di website
