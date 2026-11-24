# PPMS — Project Performance Monitoring System

A web application for monitoring water supply and sanitation projects (DWSSM). It tracks project details, physical and financial progress, quality control, environmental and social safeguards, grievances, and generates reports such as S-curves and physical/financial summaries.

Built with **Laravel 7** (PHP) and **MySQL**.

---

## Features

- **Project management**: project details, sources, structures and structure estimation, salient features, documents, staff, workers, issues.
- **Progress tracking**: progress data, monthly structure progress, progress revisions, payments, variation orders (VO), extension of time (EOT).
- **Quality control**: QC records and QC tests with file uploads and approval status.
- **Safeguards**: environment details, monthly environmental records, safeguard indicators.
- **Community and social**: beneficiaries, institutional details, programs, OBA (with Excel import), members, loan status, monitoring visits.
- **Grievances**: grievance details, grievance committees, third-level grievances.
- **Reports**: workers, programs, QC tests, OBAs, monthly progress, summary, physical/financial (detailed and summary), committee (samiti) members, S-curve. Export to Excel and PDF.
- **Administration**: users, user groups, menus, role-based access control, login/failed-login logs, and master data configuration (country, pradesh, district, municipality, fiscal year, office, PMO, designation, department, project type, test type, material and more).
- **Public API**: `GET /api/projectData` returns project data.

## Tech stack

| Layer | Technology |
|---|---|
| Backend | Laravel 7, PHP ^7.2.5 |
| Database | MySQL |
| Frontend | Blade templates, AdminLTE-style assets in `public/`, Laravel Mix |
| Key packages | `maatwebsite/excel` (Excel import/export), `barryvdh/laravel-dompdf` (PDF), `intervention/image` (images), `owen-it/laravel-auditing` (audit trail), `laravelcollective/html`, `hisorange/browser-detect` |

## Requirements

- PHP 7.2.5 – 7.4 with extensions: `pdo_mysql`, `mbstring`, `openssl`, `xml`, `ctype`, `json`, `bcmath`, `gd`, `zip`, `fileinfo`
- Composer
- MySQL 5.7+ or MariaDB
- Node.js and npm (only if you need to rebuild frontend assets)

## Installation

```bash
# 1. Clone the repository
git clone git@github.com:shree-geo/ppms.git
cd ppms

# 2. Install PHP dependencies
composer install

# 3. Create the environment file (see "Configuration" below)
cp .env.example .env    # or create .env manually
php artisan key:generate

# 4. Create the database, then run migrations and seeders
php artisan migrate
php artisan db:seed

# 5. Link the storage folder so uploaded files are publicly accessible
php artisan storage:link

# 6. Start the development server
php artisan serve
```

Open <http://localhost:8000> and log in.

### Frontend assets (optional)

Compiled assets are already in `public/`. To rebuild:

```bash
npm install
npm run dev      # development build
npm run prod     # production build
```

## Configuration

The repository does not include a `.env.example`. Create a `.env` file in the project root with at least:

```env
APP_NAME=PPMS
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppms
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

Never commit `.env`. It is already listed in `.gitignore`.

## Default users

`php artisan db:seed` creates three users, one per user group:

| User group | Email |
|---|---|
| Admin / developer | `developer@youngminds.com.np` |
| CSE | `cse@gmail.com` |
| DSMC (regional) | `regional@gmail.com` |

Their passwords are set in `database/seeds/UsersTableSeeder.php`. **Change them immediately on any shared or production server.**

## Project structure

```
app/
  Http/Controllers/          Feature controllers (projects, progress, QC, reports, ...)
  Http/Controllers/Configurations/   Master data controllers
  Models/                    Eloquent models
  Exports/, Imports/         Excel export/import classes
  Repository/                Data access helpers
  Helpers.php, Helper/File.php   Global helper functions (autoloaded)
database/
  migrations/                Database schema
  seeds/                     Master data and default users
resources/views/             Blade templates (backend/layouts holds the main layout and sidebar)
routes/
  web.php                    Web routes (all behind auth)
  api.php                    Public API routes
public/                      Compiled assets, plugins, uploads
storage/app/public/uploads/  Uploaded files (served via storage:link)
```

## Useful commands

```bash
php artisan migrate:fresh --seed   # rebuild the database from scratch (deletes all data)
php artisan optimize:clear         # clear config, route, view and cache
php artisan route:list             # list all routes
```

The app also has a `/clear_cache` route that clears caches and recreates the storage link on servers without shell access.

## Deployment notes

- Set `APP_ENV=production` and `APP_DEBUG=false`.
- Point the web server document root to the `public/` directory.
- Make `storage/` and `bootstrap/cache/` writable by the web server user.
- Run `composer install --no-dev --optimize-autoloader`, then `php artisan config:cache` and `php artisan route:cache`.
- Run `php artisan storage:link` so uploaded files are reachable.

## Branches

- `master`: main branch with the latest code.
