# Sistem Manajemen Laporan

Sistem manajemen laporan sederhana berbasis Laravel untuk mengunggah, mengelola, melihat, dan mengunduh laporan PDF untuk keperluan perusahaan.

## Fitur

- Autentikasi pengguna dengan Laravel Breeze
- **Halaman utama publik** — siapa saja (tanpa login) bisa melihat, mencari, filter, pratinjau, dan mengunduh laporan
- **Login hanya diperlukan untuk aksi kelola data (CRUD)**: tambah/edit/hapus laporan, issue, site, customer, dan user — dibatasi khusus role Admin
- Ringkasan dashboard untuk issue, site, dan laporan
- Manajemen CRUD untuk **Issues**, **Sites**, **Customers**, dan **Users**
- Unggah laporan dengan validasi PDF (maks. 10MB) dan penyimpanan file
- **Kompresi PDF otomatis** saat upload/edit (lihat bagian [Kompresi PDF (Ghostscript)](#kompresi-pdf-ghostscript))
- Filter laporan berdasarkan issue, site, bulan, tahun
- Pencarian laporan berdasarkan nama file, customer, issue, dan site
- Pratinjau dan unduh PDF — file selalu di-stream lewat controller, **tidak pernah lewat URL publik langsung**
- Notifikasi in-app untuk user & admin (laporan baru, laporan diedit/dihapus, dsb.)
- Metadata disimpan di database; file PDF disimpan di filesystem privat

## Tech Stack

- Laravel 10
- PHP 8.1+
- MySQL / MariaDB
- Tailwind CSS + Alpine.js
- Vite

## Environment

Salin file environment contoh dan perbarui pengaturan database:

```bash
cp .env.example .env
```

Nilai yang wajib diisi/disesuaikan:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

> **Catatan:** `FILESYSTEM_DISK` **tidak perlu** diubah ke `public`. Aplikasi ini secara sengaja menyimpan & menyajikan file laporan lewat disk `local` (privat) yang di-stream lewat controller (`ReportController::preview()` / `download()`), bukan lewat folder `public/storage`. Ini pilihan desain untuk keamanan — jangan diubah tanpa menyesuaikan kode di `ReportController`.

## Pengaturan Database

1. Buat database, misalnya `report_management`.
2. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```
3. Isi database (seed) untuk membuat akun default dan data contoh:
   ```bash
   php artisan db:seed
   ```

## Penyimpanan File Laporan

Aplikasi ini **tidak menggunakan** `php artisan storage:link`. File PDF yang diunggah disimpan di `storage/app/reports` (disk `local`, privat) dan **hanya bisa diakses lewat route yang sudah dikontrol**:

- `GET /reports/{report}/preview` — menampilkan PDF di browser
- `GET /reports/{report}/download` — mengunduh PDF

Kedua route ini mengecek dulu apakah file benar-benar ada di disk sebelum di-stream, dan tidak pernah mengekspos path file asli ke publik.

## Kompresi PDF (Ghostscript)

Setiap laporan yang diunggah/diedit otomatis dikompresi memakai [Ghostscript](https://www.ghostscript.com/) supaya lebih hemat ruang penyimpanan (lihat `app/Services/PdfCompressorService.php`).

- Konfigurasi path binary Ghostscript ada di `config/services.php`, diambil dari env `GHOSTSCRIPT_PATH`.
- **Windows (dev/laptop server via Laragon):** isi path lengkap ke `gswin64c.exe`, contoh:
  ```
  GHOSTSCRIPT_PATH="C:\Program Files\gs\gs10.03.0\bin\gswin64c.exe"
  ```
- **Linux/VPS:** biasanya cukup `gs` kalau Ghostscript sudah ada di PATH:
  ```
  GHOSTSCRIPT_PATH=gs
  ```
- **Kalau Ghostscript belum terinstall / tidak ditemukan**, sistem otomatis melewati proses kompresi tanpa membuat aplikasi error — file asli tetap disimpan apa adanya. Jadi fitur ini bersifat opsional/aman, tapi disarankan diinstall di laptop server supaya penyimpanan lebih efisien dalam jangka panjang.

## Menjalankan Aplikasi (Development)

Instal dependensi:

```bash
composer install
npm install
```

Build aset dan jalankan server pengembangan:

```bash
npm run dev
php artisan serve
```

Buka aplikasi di browser pada:

```text
http://127.0.0.1:8000
```

> **Untuk akses dari device lain di jaringan yang sama (misal HP)** saat masih development, jalankan `php artisan serve --host=0.0.0.0 --port=8000` (script `npm run serve` sudah melakukan ini), lalu akses dari device lain lewat **IP lokal komputer**, contoh `http://192.168.1.10:8000` — **bukan** `http://0.0.0.0:8000`. Alamat `0.0.0.0` hanya berarti "server mendengarkan di semua interface jaringan", bukan alamat yang bisa dibuka di browser.

## Menjalankan di Laptop Server (Laragon / Production Lokal)

Untuk deployment permanen di laptop server via Laragon:

1. Clone/pull project ke folder root Laragon (`laragon/www/`).
2. Ikuti langkah **Environment**, **Pengaturan Database**, dan **Kompresi PDF (Ghostscript)** di atas.
3. Build aset produksi:
   ```bash
   npm run build
   ```
4. Pastikan Apache/Nginx di Laragon aktif dan virtual host mengarah ke folder `public/` project ini.
5. Aplikasi akan tetap berjalan selama laptop server menyala dan Laragon aktif — **tidak perlu** `php artisan serve` atau `npm run dev/serve` lagi di mode ini, karena web server sudah ditangani Laragon.
6. Untuk diakses dari device lain (HP, laptop lain) di jaringan yang sama, gunakan IP lokal laptop server, contoh `http://192.168.1.10`.

## Akun Default

Jika seeding dijalankan, tersedia 2 akun contoh:

| Role  | Email             | Password   |
|-------|-------------------|------------|
| Admin | admin@local.test  | secret123  |
| User  | user@local.test   | secret123  |

> ⚠️ **Segera ganti password akun-akun ini** sebelum aplikasi benar-benar dipakai sehari-hari oleh tim. Jangan biarkan kredensial default ini aktif di lingkungan produksi.

## Struktur Peran (Role)

- **Guest (tanpa login):** hanya bisa melihat, mencari, filter, pratinjau, dan mengunduh laporan di halaman utama.
- **User:** sama seperti guest, ditambah menerima notifikasi in-app (laporan baru, laporan diedit/dihapus, dll).
- **Admin:** akses penuh — kelola laporan, issue, site, customer, dan user (CRUD). Sistem selalu menjaga minimal 1 akun admin aktif (tidak bisa dihapus/diturunkan rolenya kalau itu admin terakhir).

## Catatan

- File PDF disimpan secara lokal di disk `local` (privat), bukan sebagai BLOB di database, dan tidak pernah diekspos lewat folder `public/`.
- Root `/` selalu mengarah ke halaman **daftar laporan** (`reports.index`) yang bisa diakses tanpa login. Login hanya diperlukan saat mengakses halaman kelola data (tambah/edit/hapus).
