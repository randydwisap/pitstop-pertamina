# Pitstop Pertamina

Panduan instalasi dan setup proyek **Laravel + Filament** untuk pengembangan lokal dan produksi (Hostinger).

---

## Prasyarat

- **PHP** 8.1/8.2 dengan ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `curl`, `intl`, `bcmath`, `zip`
- **Composer**
- **MySQL/MariaDB**
- (Produksi) Akses **SSH** Hostinger

---

## Instalasi Lokal (Development)

```bash
# 1) Clone repo
git clone https://github.com/randydwisap/pitstop-pertamina.git
cd pitstop-pertamina

# 2) Install dependencies
composer install    # atau: composer update

# 3) Salin & atur environment
cp .env.example .env
# -> edit .env: DB_*, APP_URL, dll

# 4) Generate app key
php artisan key:generate

# 5) Migrasi database
php artisan migrate

# 6) Buat user admin Filament
php artisan make:filament-user
# -> isi email & password sesuai prompt

# 7) Seed Roles
php artisan db:seed --class=RolesSeeder
