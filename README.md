# Sistem Manajemen Laporan
Sistem manajemen laporan sederhana berbasis Laravel untuk mengunggah, mengelola, melihat, dan mengunduh laporan PDF untuk keperluan perusahaan.

## Fitur
- Autentikasi pengguna dengan Laravel Breeze
- Ringkasan dashboard untuk issue, site, dan laporan
- Manajemen CRUD untuk Issues dan Sites
- Unggah laporan dengan validasi PDF dan penyimpanan file
- Filter laporan berdasarkan issue, site, bulan, tahun
- Pencarian laporan berdasarkan judul, nama file, issue, dan site
- Pratinjau dan unduh PDF
- Metadata disimpan di database; file PDF disimpan di filesystem
- Dukungan peran Admin untuk operasi tulis yang dilindungi

## Tech Stack
- Laravel 10
- PHP 8.1+
- MySQL / MariaDB
- Tailwind CSS
- Vite

## Environment
Salin file environment contoh dan perbarui pengaturan database:
```bash
cp .env.example .env
```
Nilai yang wajib diisi:
- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `FILESYSTEM_DISK=public`

## Pengaturan Database
1. Buat database, misalnya `report_management`.
2. Jalankan migrasi:
```bash
php artisan migrate
```
3. Isi database (seed) untuk membuat akun admin default dan data contoh:
```bash
php artisan db:seed
```

## Pengaturan Storage
Jalankan perintah storage link agar file PDF yang diunggah dapat diakses:
```bash
php artisan storage:link
```
File PDF yang diunggah akan disimpan di `storage/app/public/reports` dan disajikan dari `public/storage/reports`.

## Menjalankan Aplikasi
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

## Akun Default
Jika seeding dijalankan, akun admin default-nya adalah:
- Email: `admin@local.test`
- Password: `secret123`

> Segera ubah password ini untuk penggunaan di production.

## Catatan
- File PDF disimpan secara lokal, bukan sebagai BLOB di database.
- Aplikasi ini menggunakan `FILESYSTEM_DISK=public` dan `storage/app/public`.
- Root `/` akan mengarahkan ke halaman login/dashboard tergantung status autentikasi.
