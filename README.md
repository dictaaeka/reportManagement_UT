# Report Management System

A simple Laravel-based report management system for uploading, organizing, viewing, and downloading PDF reports for corporate use.

## Features

- User authentication with Laravel Breeze
- Dashboard summary for issues, sites, and reports
- CRUD management for Issues and Sites
- Report upload with PDF validation and file storage
- Report filtering by issue, site, month, year
- Search reports by title, filename, issue, and site
- PDF preview and download
- Metadata saved in database; PDF files stored in filesystem
- Admin role support for protected write operations

## Tech Stack

- Laravel 10
- PHP 8.1+
- MySQL / MariaDB
- Tailwind CSS
- Vite

## Environment

Copy the example environment file and update the database settings:

```bash
cp .env.example .env
```

Required values:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `FILESYSTEM_DISK=public`

## Database Setup

1. Create a database, for example `report_management`.
2. Run migrations:

```bash
php artisan migrate
```

3. Seed the database to create default admin and sample records:

```bash
php artisan db:seed
```

## Storage Setup

Run the storage link command so uploaded PDFs are accessible:

```bash
php artisan storage:link
```

Uploaded PDFs will be stored in `storage/app/public/reports` and served from `public/storage/reports`.

## Run Application

Install dependencies:

```bash
composer install
npm install
```

Build assets and run the dev server:

```bash
npm run dev
php artisan serve
```

Open the application in your browser at:

```text
http://127.0.0.1:8000
```

## Default Account

If seeding is run, the default admin account is:

- Email: `admin@local.test`
- Password: `secret123`

> Change this password immediately for production use.

## Notes

- PDF files are stored locally, not as database BLOBs.
- The app uses `FILESYSTEM_DISK=public` and `storage/app/public`.
- Root `/` redirects to login/dashboard based on authentication state.

## GitHub Push

To push to GitHub, I need:

1. A remote repository URL (HTTPS or SSH).
2. Access credentials or SSH key configured in this environment.

If you provide the remote URL, I can add it and push the local commit.
