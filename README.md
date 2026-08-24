# Report Management UT

Sistem manajemen laporan berbasis Laravel untuk mengunggah, mengelola, mencari, melihat (preview), dan mengunduh laporan PDF perusahaan. Halaman daftar laporan bersifat **publik** (tanpa login), sedangkan pengelolaan data (CRUD) **khusus Admin**.

## 1. Project Overview

Aplikasi internal untuk tim, dijalankan di satu laptop server yang terhubung ke jaringan Wi-Fi/LAN kantor — **tidak menggunakan hosting/cloud**. Perangkat lain (laptop/HP) di jaringan yang sama mengakses aplikasi lewat browser menggunakan IP laptop server.

## 2. Fitur

- Halaman daftar laporan publik — bisa diakses **tanpa login** oleh siapa saja di jaringan kantor
- Search laporan (nama file, customer, issue, site)
- Filter laporan (issue, site, unit model, bulan, tahun)
- Preview PDF langsung di browser & download PDF — file selalu di-stream lewat controller, **tidak pernah** lewat URL publik langsung
- Login **khusus Admin** untuk mengelola data
- CRUD Reports, Issues, Sites, Customers, Unit Models, Users (semua khusus Admin)
- Upload laporan dengan validasi PDF (maksimal 10 MB)
- Kompresi PDF otomatis saat upload/edit lewat Ghostscript (opsional — aplikasi tetap berjalan normal kalau Ghostscript belum terinstall)
- Notifikasi in-app untuk admin & user terdaftar (laporan baru/diedit/dihapus, aktivitas CRUD lain)
- Proteksi admin terakhir: sistem selalu menjaga minimal 1 akun Admin aktif

## 3. User Roles

| Role | Perlu login? | Akses |
|---|---|---|
| **Guest** (siapa saja) | Tidak | Lihat, cari, filter, preview, download laporan |
| **User** | Ya (opsional, hanya untuk notifikasi) | Sama seperti Guest + menerima notifikasi in-app |
| **Admin** | Ya, wajib | Akses penuh: CRUD Reports, Issues, Sites, Customers, Unit Models, Users |

Tidak ada halaman registrasi publik — akun baru hanya bisa dibuat oleh Admin lewat menu **Users**.

## 4. Technology Stack

- Laravel 10 (PHP `^8.1`)
- MySQL 8.0 / MariaDB 10.6+
- Blade + Tailwind CSS + Alpine.js (dengan Laravel Breeze sebagai basis autentikasi)
- Vite 5 untuk build asset frontend
- Ghostscript (opsional) untuk kompresi PDF

## 5. System Requirements

| Software | Versi | Wajib? |
|---|---|---|
| PHP | 8.1 atau 8.2 | Wajib |
| Composer | 2.x | Wajib |
| Node.js | 18 LTS / 20 LTS | Wajib |
| npm | Bundled dengan Node | Wajib |
| MySQL / MariaDB | MySQL 8.0.x / MariaDB 10.6+ | Wajib |
| Git | Versi terbaru | Wajib |
| Ghostscript | Terbaru | Opsional (kompresi PDF) |

Ekstensi PHP yang harus aktif: `openssl`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `curl`, `bcmath`.

## 6. Installation

### 6.1 Clone Repository

```bash
git clone <URL-repository-Anda>
cd reportManagement_UT
```

### 6.2 Composer Installation

```bash
composer install
```

### 6.3 NPM Installation

```bash
npm install
```

### 6.4 Environment Setup

```bash
copy .env.example .env
```
*(di Linux/Mac: `cp .env.example .env`)*

Sesuaikan minimal variable berikut di `.env`:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=http://192.168.x.x:8000

DB_DATABASE=report_management
DB_USERNAME=<user MySQL Anda>
DB_PASSWORD=<password MySQL Anda>
```

> `FILESYSTEM_DISK` **tidak perlu** diubah ke `public`. Aplikasi ini sengaja menyimpan & menyajikan file laporan lewat disk `local` (privat) yang di-stream lewat controller (`ReportController::preview()` / `download()`), bukan lewat folder `public/storage`. Jangan diubah tanpa menyesuaikan kode di `ReportController`.

### 6.5 Generate APP_KEY

```bash
php artisan key:generate
```

### 6.6 Database Setup

**Pilih salah satu jalur (jangan dicampur):**

**Jalur A — Import SQL dump (rekomendasi kalau ingin data kerja yang sudah ada ikut terbawa):**
```bash
mysql -u root -p -e "CREATE DATABASE report_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p report_management < report_management.sql
```

**Jalur B — Migration + Seeder (kalau ingin mulai dari database bersih, hanya 2 akun default):**
```bash
php artisan migrate
php artisan db:seed
```

Verifikasi koneksi:
```bash
php artisan migrate:status
```

### 6.7 Storage Setup

`php artisan storage:link` **tidak diperlukan** — aplikasi ini tidak memakai disk publik untuk PDF.

Kalau Anda memakai Jalur A (import SQL) dan sudah punya laporan PDF dari laptop development sebelumnya, **salin manual** isi folder `storage/app/reports/` dari laptop development ke lokasi yang sama persis di laptop server (lewat USB/network share/cara transfer lain). Folder ini **tidak ikut** lewat `git clone` karena memang sengaja di-`.gitignore` (file upload user tidak boleh masuk version control).

### 6.8 Frontend Build

```bash
npm run build
```
Gunakan `npm run build` (bukan `npm run dev`) untuk server — asset akan menjadi file statis permanen, tidak perlu proses Vite tetap menyala.

## 7. Running Application

```bash
php artisan serve --host=0.0.0.0 --port=8000
```
atau, karena sudah tersedia script yang sama di `package.json`:
```bash
npm run serve
```

Buka `http://localhost:8000` di laptop server untuk memastikan aplikasi berjalan.

## 8. Admin Login

Akun default (hasil seeder / data awal):

| Role | Email | Password default |
|---|---|---|
| Admin | `admin@local.test` | `secret123` |
| User | `user@local.test` | `secret123` |

> ⚠️ **Wajib ganti password akun-akun ini** (lewat menu Users setelah login) sebelum aplikasi dipakai tim sehari-hari. Jangan biarkan kredensial default tetap aktif.

## 9. Public User Flow

1. Buka `http://192.168.x.x:8000` — langsung menampilkan daftar laporan, tanpa login.
2. Gunakan kolom search / filter (issue, site, unit model, bulan, tahun) untuk mencari laporan.
3. Klik laporan untuk preview PDF langsung di browser, atau tombol download.
4. Untuk mengelola data (tambah/edit/hapus laporan atau data master lain), klik **Login** dan masuk dengan akun Admin.

## 10. LAN / Wi-Fi Access

1. Di laptop server, jalankan `ipconfig` (PowerShell/CMD) dan catat **IPv4 Address** pada adapter Wi-Fi (atau Ethernet, sesuai koneksi laptop server ke jaringan kantor).
2. Jalankan aplikasi dengan `php artisan serve --host=0.0.0.0 --port=8000` (bukan tanpa `--host`, karena default Laravel hanya listen di `127.0.0.1`).
3. Buat inbound rule Windows Firewall untuk port 8000 (PowerShell as Administrator):
   ```powershell
   New-NetFirewallRule -DisplayName "Laravel Report Management (Port 8000)" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow
   ```
4. Dari perangkat lain **di Wi-Fi kantor yang sama**, buka `http://<IP-laptop-server>:8000` (contoh: `http://192.168.1.25:8000`).
5. Disarankan membuat IP laptop server **static/reserved** (lewat pengaturan router kantor atau setting manual IP di laptop server) supaya URL tidak berubah-ubah setiap kali laptop restart/DHCP lease habis.

## 11. Troubleshooting

| Gejala | Kemungkinan penyebab |
|---|---|
| `localhost:8000` di laptop server sendiri tidak bisa dibuka | Error di Laravel/PHP — cek terminal `artisan serve`, cek `.env` |
| Laptop server bisa akses lewat `localhost`, tapi IP LAN-nya sendiri tidak bisa | `artisan serve` dijalankan tanpa `--host=0.0.0.0` |
| Laptop server bisa akses lewat IP-nya, perangkat lain tidak bisa | Windows Firewall memblokir port 8000 — lihat langkah 3 di atas |
| Semua sudah benar tapi tetap gagal, `ping` ke IP server juga gagal | Kedua perangkat tidak berada di jaringan Wi-Fi yang sama, atau router mengaktifkan AP/Client Isolation |
| Preview/download PDF gagal (404) untuk laporan lama | File fisik PDF belum dipindahkan ke `storage/app/reports/` di laptop server — lihat Section 7 |
| Halaman error menampilkan detail kode/stack trace | `APP_DEBUG` masih `true` di `.env` — ubah ke `false` |

## 12. Git Workflow

- `.env` **tidak pernah** dikomit — sudah di-`.gitignore`.
- File PDF di `storage/app/reports/` **tidak ikut Git** — sengaja diignore lewat `storage/app/.gitignore` bawaan Laravel. Pindahkan manual saat deploy ke server baru.
- `vendor/` dan `node_modules/` **tidak ikut Git** — generate ulang dengan `composer install` dan `npm install` di setiap environment baru.
- `composer.phar` dan `composer-setup.php` sebaiknya **tidak** disimpan di repo (lihat `.gitignore`) — install Composer langsung di komputer masing-masing lewat https://getcomposer.org.
