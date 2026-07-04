# Company Profile - CV. Karya Perdana Teknik

Selamat datang di repository sistem Company Profile **CV. Karya Perdana Teknik**. Website ini dirancang khusus untuk mempresentasikan profil perusahaan, layanan, galeri, dan artikel, dilengkapi dengan fitur pelacakan *leads* (calon klien) secara cerdas yang terintegrasi dengan WhatsApp.

**Developer:** Ilhammaulana | HVM Digital  
**Versi:** 1.0.0  

---

## 🚀 Fitur Utama

### 1. Desain Premium & Responsif
- **Apple Widget UI Aesthetics:** Panel admin dirancang menggunakan gaya desain ala *Apple Widget* (radius melengkung elegan, *glassmorphism*, dan *drop-shadow* lembut).
- **Tipografi Modern:** Menggunakan perpaduan *Plus Jakarta Sans* dan *Montserrat* (Tipis) yang memberikan kesan profesional, premium, dan mudah dibaca.
- **Micro-Animations:** Transisi halus pada setiap *hover* elemen, tombol, dan navigasi (AOS Animation).
- **Dynamic Theming:** Tema warna utama, warna aksen, dan background hero dapat diubah langsung melalui halaman admin.

### 2. Panel Admin Canggih
- **Dashboard Analitik:** Melacak metrik pengunjung secara akurat (Visitor, Leads WhatsApp, dan CTR) berdasarkan filter rentang tanggal.
- **Rich Text Editor:** Editor konten artikel dan layanan terintegrasi dengan fitur **Native Image Upload** (mengunggah dan menyisipkan gambar dengan format WebP tanpa reload, tanpa plugin pihak ketiga).
- **Manajemen Lengkap:** Sistem CRUD (*Create, Read, Update, Delete*) lengkap untuk Artikel, Layanan, Galeri, dan Pengaturan.
- **Konfigurasi Super Fleksibel:** Pengaturan kontak, SEO (Title, Description, Keyword, Meta Image), Teks Berjalan (*Running Text*), Logo, dan Sosial Media sepenuhnya dapat dikelola dari Panel Admin tanpa menyentuh kode.

### 3. Sistem Tracking WhatsApp (Lead Interceptor)
- **Event Delegation Interceptor:** Semua klik yang mengarah ke tautan WhatsApp (`wa.me`, `api.whatsapp.com`, dll) di seluruh penjuru website akan otomatis dicegat secara pintar.
- **Pop-up Form Leads:** Pengunjung wajib mengisi form mini (opsional/wajib sesuai konfigurasi) sebelum diarahkan ke chat WhatsApp admin.
- **Konversi Otomatis:** Data yang dimasukkan akan terekam di database sebagai "Leads", memungkinkan perusahaan menghitung efektivitas *call-to-action* (CTR).

### 4. SEO & Kinerja (Performance)
- Optimalisasi Meta Tags (Open Graph, Twitter Cards, Canonical URL) secara dinamis.
- Kompresi gambar otomatis ke format WebP menggunakan GD Library.
- Caching pada route, view, dan config untuk kecepatan loading maksimum.
- Tersedia halaman khusus Error (404 Not Found & 500 Internal Error) yang terintegrasi dengan *layout* utama website.

---

## 🛠 Teknologi yang Digunakan

Website ini dibangun di atas pondasi arsitektur modern yang kuat dan teruji:
- **Backend:** Laravel 11 (PHP 8.2+)
- **Database:** SQLite / MySQL (Fleksibel melalui `.env`)
- **Frontend Engine:** Blade Templating
- **Styling:** Vanilla CSS (CSS Variables) + TailwindCSS (Optional build)
- **Javascript:** Vanilla JS (ES6) + AJAX Fetch API
- **Image Processing:** Native PHP GD Library (Konversi ke WebP)

---

## 🔐 Keamanan & Standar Pengodean
- Perlindungan dari serangan XSS (Cross-Site Scripting) menggunakan *escaping* Blade (`{{ }}`).
- Perlindungan form dari serangan CSRF menggunakan token `@csrf`.
- Validasi ketat pada setiap permintaan (*Form Request Validation*) di sisi server.
- Proteksi route Admin dengan Middleware `auth`.

---

## 📞 Hubungi Pengembang
Jika Anda membutuhkan bantuan modifikasi lebih lanjut, instalasi, atau penambahan fitur khusus, silakan hubungi pengembang:

**Ilhammaulana | HVM Digital**  
Website: [hvmdigital.id](https://hvmdigital.id)
