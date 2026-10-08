# ⚡ HVM Digital — Modular B2B Business Web Platform

**Arsitektur:** White-Label · Database-Driven · Headless-Ready · Full CMS  
**Framework:** Laravel 13.x (PHP 8.3+)  
**Pola Desain:** Modular CMS — seluruh konten, warna, teks, SEO, dan tampilan dikontrol penuh via database tanpa hardcode

---

## 🧠 Konsep Arsitektur: Modular Web CMS

Platform ini dirancang dengan filosofi **"zero-hardcode"** — tidak ada teks, warna, URL, atau konfigurasi yang dikunci di source code. Setiap aspek website dikontrol melalui **sistem Settings berbasis database** yang di-cache secara otomatis.

### Prinsip Utama:
```
┌─────────────────────────────────────────────────────────────────┐
│                    DATABASE (settings table)                     │
│                    key=value, group, type                        │
└──────────────┬──────────────────────────────┬───────────────────┘
               │ Setting::getAllAsArray()       │ Setting::get(key)
               ▼                               ▼
    ┌─────────────────┐               ┌──────────────────┐
    │  Controllers    │               │  Blade Views     │
    │  (lokal cache)  │               │  ($settings[key])│
    └────────┬────────┘               └────────┬─────────┘
             │                                 │
             ▼                                 ▼
    ┌──────────────────────────────────────────────────────┐
    │                  RENDERED HTML                       │
    │   Konten dinamis · SEO dinamis · Warna dinamis      │
    └──────────────────────────────────────────────────────┘
```

**Akibatnya:** Satu codebase yang sama bisa di-deploy untuk klien yang berbeda hanya dengan menjalankan `DatabaseSeeder` yang berbeda — tidak perlu modifikasi source code apapun.

---

## 🛠 Tech Stack

| Komponen | Detail |
|---|---|
| **Framework** | Laravel 13.x (PHP 8.3+) |
| **Database** | MySQL (production) / SQLite (development) |
| **Template Engine** | Blade — semua konten dinamis dari DB |
| **Image Processing** | Intervention Image 4.0 — auto-convert semua upload ke **WebP** |
| **Caching** | Laravel File Cache — settings di-cache 7200s per key |
| **PDF Export** | barryvdh/laravel-dompdf 3.0 |
| **Excel Export** | maatwebsite/excel 3.1 |
| **Sitemap** | spatie/laravel-sitemap 8.0 — auto-generate XML sitemap |
| **CSS** | Vanilla CSS + Design Tokens berbasis CSS Custom Properties |
| **Hosting** | Hostinger Shared (web root: `public_html/`) |
| **Deploy** | PowerShell → SSH → Git pull → Artisan seed + optimize |

---

## ⚙️ Sistem Settings — Otak Platform

### Model `Setting` (key-value store dengan cache)

```php
// Read (dengan L2 cache 2 jam)
Setting::get('company_name')             // → "Nama Klien"
Setting::get('page_about_hero_title')    // → "Judul Halaman About"

// Bulk read (1 query, cached ke array flat)
Setting::getAllAsArray()   // → ['key' => 'value', ...]

// Write (auto-invalidate cache)
Setting::set('key', $value, 'text', 'group')
```

### Kategori Setting yang Tersedia

| Group | Key Contoh | Keterangan |
|---|---|---|
| `general` | `company_name`, `company_phone` | Identitas bisnis |
| `hero` | `hero_headline`, `hero_subheadline`, `hero_cta_primary` | Teks hero homepage |
| `section` | `value_section_label`, `aplikasi_section_title` | Judul tiap section homepage |
| `about` | `about_heading`, `about_text`, `visi`, `misi` | Konten halaman about |
| `stats` | `stat_years`, `stat_clients`, `stat_products` | Statistik bisnis |
| `contact` | `phone`, `wa1`, `email`, `address` | Informasi kontak |
| `footer` | `footer_desc`, `copyright` | Teks footer |
| `seo` | `meta_title_home`, `meta_desc_home` | SEO meta global |
| `page_hero` | `page_about_hero_label`, `page_product_hero_title` | Hero per halaman inner |
| `page_management` | `header_accent_color`, `gallery_badge_color` | Warna & gaya per section |
| `image` | `logo`, `about_image`, `og_image_default` | Aset gambar global |

---

## 🌐 Dynamic SEO Architecture

Semua metadata SEO **100% dinamis** — tidak ada yang hardcode di HTML.

### Komponen SEO Terpusat (`components/seo.blade.php`)

```html
<!-- Meta Tags Dinamis -->
<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">
<meta name="keywords" content="{{ $seo['keywords'] }}">

<!-- Open Graph (Facebook / WhatsApp Preview) -->
<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:image" content="{{ $seo['og_image'] }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">

<!-- Canonical URL (selalu HTTPS production) -->
<link rel="canonical" href="{{ $seo['canonical'] }}">

<!-- Geo Meta (Local SEO) -->
<meta name="geo.region" content="ID">
<meta name="geo.placename" content="{{ Setting::get('address') }}">
```

### JSON-LD Schema Markup (Dinamis per Halaman)

| Halaman | Schema Type |
|---|---|
| Homepage | `LocalBusiness`, `WebSite` |
| Produk List | `ItemList` |
| Produk Detail | `Product`, `FAQPage`, `BreadcrumbList` |
| Artikel Detail | `Article`, `FAQPage`, `BreadcrumbList` |
| Kontak | `FAQPage` |
| Galeri | `ImageObject` |

Semua nilai dalam schema (nama bisnis, URL, alamat, rating, dsb) diambil dari database — tidak ada nilai statis di source code.

---

## 📄 Page Management — Customizable Per Halaman

Admin dapat mengkustomisasi **hero section setiap halaman inner** melalui `/admin/page-management` tanpa menyentuh kode.

### Halaman yang Fully Configurable via Admin:

| Halaman | Setting Keys | Akses Admin |
|---|---|---|
| **Homepage** | Hero slides, section labels, button colors, warna aksen | Tab Homepage |
| **Header** | Warna utama, warna hover, menu navigasi | Tab Header |
| **About** | `page_about_hero_label`, `page_about_hero_title`, `page_about_hero_desc` | Tab About |
| **Produk** | `page_product_hero_label`, `page_product_hero_title`, `page_product_hero_desc` | Tab Produk |
| **Artikel** | `page_article_hero_label`, `page_article_hero_title`, `page_article_hero_desc` | Tab Artikel |
| **Kontak** | `page_contact_hero_label`, `page_contact_hero_title`, `page_contact_hero_desc` | Tab Kontak |
| **Gallery** | Warna hover overlay, warna badge aktif, shadow color | Sub-tab Galeri |
| **Client Section** | Logo auto-WebP, auto alt text (`[klien] customer [bisnis]`) | Sub-tab Client |
| **Hero Slides** | Judul, subtitle, gambar (auto-WebP, 3448×914px) | Sub-tab Hero |

---

## 🖼 Image Pipeline — Auto WebP Conversion

**Setiap gambar yang di-upload otomatis diproses:**

```
Upload (any format)
    │
    ▼
Intervention Image 4.0
    ├─ Resize (sesuai target: banner, logo, thumbnail)
    ├─ Convert → WebP
    └─ Kualitas 80-85% (lossy, optimal size)
    │
    ▼
storage/app/public/{category}/{uuid}.webp
    │
    ▼
public_html/storage → symlink
    │
    ▼
https://domain.com/storage/{category}/{uuid}.webp
```

**Target size per kategori:**
| Kategori | Max Width | Kualitas | Rasio |
|---|---|---|---|
| Hero Slide | 3448px | 85% | Ultra-wide |
| Logo Klien | 500px | 85% | Flexible |
| Gambar Produk | 1920px | 85% | Auto |
| Galeri | 1920px | 85% | Auto |
| Artikel | 1200px | 80% | Auto |
| Pages / Settings | 1920px | 85% | Auto |

---

## 🔄 Auto-Hide Logic — Smart Section Visibility

Section di homepage **otomatis sembunyi** jika tidak ada konten — tidak perlu toggle manual:

```php
// homepage (home/index.blade.php)
@if($galleryProjects->count())      // Gallery section hanya tampil jika ada foto
@if($clients->count())              // Client marquee hanya tampil jika ada logo klien
@if($testimonials->count())         // Testimoni hanya tampil jika ada data

// Berlaku juga di:
// - components/testimonials.blade.php
// - Semua conditional section homepage
```

---

## 📊 Internal Analytics (Privacy-First)

Tracking kunjungan tanpa Google Analytics — data tersimpan lokal di database:

```
Request masuk → Middleware track.pageview
    │
    ├─ URL, Referrer, User Agent
    ├─ Device Type (Mobile/Tablet/Desktop)
    ├─ IP → Geo lookup via ip-api.com (cached 24 jam)
    └─ Simpan ke tabel analytics_events
```

**Export:** Excel & PDF dari admin dashboard.

---

## 🔒 Admin Panel — Modul Lengkap

URL: `/admin` — Protected via session middleware `admin.auth`

| Modul | URL | Fungsi |
|---|---|---|
| Dashboard | `/admin` | Statistik, grafik, leads terbaru |
| Analytics | `/admin/analytics` | Kunjungan, device, referrer, realtime, export |
| Leads | `/admin/leads` | Inquiry dari form kontak & order |
| Produk | `/admin/services` | CRUD produk, gambar, FAQ, meta SEO |
| Galeri | `/admin/gallery` | CRUD foto, auto-WebP, auto alt text |
| Artikel | `/admin/articles` | CRUD blog, rich content, meta SEO |
| Klien | `/admin/clients` | Logo mitra, auto-WebP, auto alt text |
| Testimoni | `/admin/testimonials` | CRUD review pelanggan |
| WhatsApp | `/admin/wa-settings` | Multi-nomor WA, template pesan |
| Settings | `/admin/settings` | Identitas, kontak, sosmed, SEO global |
| **Page Management** | `/admin/page-management` | Kustomisasi semua halaman (6 tab utama) |

---

## ⚡ Performance Architecture

```
┌─────────────────────────────────────────────────┐
│  LAYER 1: HTTP Cache (.htaccess)                │
│  Gambar: 1 tahun · CSS/JS: 1 bulan              │
└────────────────────────┬────────────────────────┘
                         │
┌────────────────────────▼────────────────────────┐
│  LAYER 2: Laravel Cache (File Driver)           │
│  Settings: 7200s · IP Geo: 86400s               │
└────────────────────────┬────────────────────────┘
                         │
┌────────────────────────▼────────────────────────┐
│  LAYER 3: Blade View Cache                      │
│  php artisan view:cache                         │
└────────────────────────┬────────────────────────┘
                         │
┌────────────────────────▼────────────────────────┐
│  LAYER 4: Frontend Optimizations                │
│  · CSS Inline (no render-blocking)              │
│  · Font non-blocking (media="print" swap)       │
│  · JS deferred / async                          │
│  · LCP Preload pada gambar hero                 │
│  · loading="lazy" semua gambar non-hero         │
│  · WebP format (50-70% lebih kecil dari JPG)    │
└─────────────────────────────────────────────────┘
```

---

## 📁 Struktur Direktori

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php          # Homepage
│   │   │   ├── ServiceController.php       # Produk list & detail
│   │   │   ├── ArticleController.php       # Blog list & detail
│   │   │   ├── AboutController.php         # About page
│   │   │   ├── ContactController.php       # Contact + form handler
│   │   │   ├── GalleryController.php       # Gallery page
│   │   │   └── Admin/
│   │   │       ├── AdminPageManagementController.php
│   │   │       ├── AdminHeroSlideController.php
│   │   │       ├── AdminClientController.php
│   │   │       ├── AdminGalleryController.php
│   │   │       └── ... (14 controller admin)
│   │   ├── Middleware/
│   │   │   ├── AdminAuthMiddleware.php
│   │   │   └── TrackPageview.php           # Internal analytics
│   │   └── Traits/
│   │       └── HandlesImageUpload.php      # WebP conversion pipeline
│   ├── Models/
│   │   ├── Setting.php                     # Key-value store + cache
│   │   ├── Service.php                     # Produk
│   │   ├── GalleryProject.php              # Foto galeri + auto alt
│   │   ├── Article.php                     # Blog
│   │   ├── Client.php                      # Logo klien + auto alt
│   │   ├── Testimonial.php
│   │   ├── HeroSlide.php
│   │   ├── WaSetting.php
│   │   ├── Lead.php
│   │   └── AnalyticsEvent.php
│   └── Providers/
│       └── AppServiceProvider.php          # View::share global vars
├── database/
│   ├── migrations/                         # 20+ migration
│   └── seeders/
│       ├── DatabaseSeeder.php              # Master seeder (settings + content)
│       ├── HeroSlideSeeder.php
│       ├── CategorySeeder.php
│       └── SeoSeeder.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php                  # Layout public
│   │   └── admin.blade.php                # Layout admin
│   ├── components/
│   │   ├── seo.blade.php                  # Semua meta, OG, schema JSON-LD
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   ├── keunggulan.blade.php           # Section keunggulan (modular)
│   │   ├── testimonials.blade.php         # Auto-hide jika kosong
│   │   ├── order-modal.blade.php          # Modal WA multi-number
│   │   └── wa-button.blade.php
│   ├── home/ · services/ · gallery/
│   ├── articles/ · about/ · contact/
│   └── admin/
│       └── page_management/
│           └── index.blade.php            # 6 main tabs + subtabs
├── routes/web.php                         # Semua route public + admin
├── public_html/                           # Web root Hostinger
│   ├── .htaccess                          # Cache headers + FollowSymLinks
│   ├── index.php
│   └── storage → symlink
└── deploy.ps1                             # Deploy script (PowerShell → SSH)
```

---

## 🗃 Database Schema

| Tabel | Keterangan |
|---|---|
| `settings` | **Key-value store** — seluruh konfigurasi site dinamis |
| `services` | Produk/layanan (CRUD admin) |
| `service_categories` | Kategori produk |
| `gallery_projects` | Foto galeri + auto alt text |
| `articles` | Blog/artikel + meta SEO |
| `clients` | Logo klien, auto alt = "[klien] customer [bisnis]" |
| `testimonials` | Testimoni pelanggan |
| `hero_slides` | Slide banner homepage |
| `wa_settings` | Multi-nomor WhatsApp + template pesan |
| `leads` | Inquiry dari form (kontak, order) + UTM tracking |
| `analytics_events` | Kunjungan halaman (privasi-first, no GA) |
| `users` | Admin panel login |
| `cache` | Laravel cache storage |
| `jobs` | Queue jobs |

---

## 🚀 Setup & Deployment

### Local Development

```bash
git clone <repo-url>
cd <project>

composer install

cp .env.example .env
# Edit DB_* dan APP_URL

php artisan key:generate
php artisan migrate
php artisan db:seed        # Seed settings + konten default
php artisan storage:link

php artisan serve
```

### Deploy ke Production (PowerShell)

```powershell
./deploy   # atau: powershell -ExecutionPolicy Bypass -File .\deploy.ps1
```

Script otomatis:
1. `git add . && git commit && git push origin main`
2. SSH ke server → `git pull`
3. `php artisan migrate --force`
4. `php artisan db:seed --class=DatabaseSeeder --force`
5. Sync `public_html/`, storage symlink, permissions
6. `php artisan optimize` + `view:cache` + `event:cache`

### Environment Variables Kritis

```env
APP_NAME="Nama Klien"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-klien.com

DB_CONNECTION=mysql
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

FILESYSTEM_DISK=public
CACHE_STORE=file
SESSION_DRIVER=file
```

---

## 🔧 White-Label Deployment Checklist

Untuk deploy ke klien baru dengan codebase yang sama:

- [ ] Buat `.env` baru dengan kredensial DB klien
- [ ] Update `DatabaseSeeder.php` — ubah `company_name`, konten default, artikel, klien seed
- [ ] Jalankan `php artisan db:seed`
- [ ] Upload logo & gambar via admin panel (`/admin/settings`)
- [ ] Kustomisasi warna via `/admin/page-management` → Tab Header
- [ ] Update teks semua halaman via `/admin/page-management` → Tab About/Produk/Artikel/Kontak
- [ ] Update hero slides via `/admin/page-management` → Sub-tab Hero Section
- [ ] Upload logo klien via `/admin/clients`
- [ ] Tambah nomor WA via `/admin/wa-settings`
- [ ] Verifikasi SEO: meta title, description, schema JSON-LD via `/admin/settings`

---

## 📦 Composer Packages

| Package | Versi | Fungsi |
|---|---|---|
| `laravel/framework` | ^13.7 | Core framework |
| `intervention/image` | 4.0 | Auto-resize & convert → WebP |
| `barryvdh/laravel-dompdf` | ^3.0 | PDF export (leads, analytics) |
| `maatwebsite/excel` | ^3.1 | Excel export (leads, analytics) |
| `spatie/laravel-sitemap` | 8.0 | Auto XML sitemap |

---

## 🔗 Route Map

| Halaman | URL | Controller |
|---|---|---|
| Beranda | `/` | `HomeController@index` |
| Produk | `/products` | `ServiceController@index` |
| Detail Produk | `/products/{slug}` | `ServiceController@show` |
| Galeri | `/gallery` | `GalleryController@index` |
| Artikel | `/articles` | `ArticleController@index` |
| Detail Artikel | `/articles/{slug}` | `ArticleController@show` |
| About | `/about` | `AboutController@index` |
| Kontak | `/contact` | `ContactController@index` |
| Sitemap XML | `/sitemap.xml` | Auto (spatie) |
| Sitemap HTML | `/sitemap` | `SitemapController` |
| **Admin** | `/admin/*` | Admin controllers |
| Page Management | `/admin/page-management` | `AdminPageManagementController` |

---

*Dibangun oleh **HVM Digital** — dgtilhammln-cmd*  
*Arsitektur: Modular Database-Driven CMS · Zero-Hardcode · White-Label Ready*
