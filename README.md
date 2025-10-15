# Pitstop Pertamina — README

Panduan ringkas instalasi dan setup proyek **Laravel + Filament** serta instruksi khusus untuk **storage link** di server Hostinger.

---

## 🔧 Cara Install (Lokal / Development)

1. Buat folder untuk direktori proyek.
2. Buka Terminal, clone repository:
   ```bash
   git clone https://github.com/randydwisap/pitstop-pertamina.git
   cd pitstop-pertamina
   ```
3. Install dependensi:
   ```bash
   composer u
   # atau: composer install
   ```
4. Atur koneksi database di file `.env`.
5. Migrasi database:
   ```bash
   php artisan migrate
   ```
6. Buat user:
   ```bash
   php artisan make:filament-user
   ```
7. Jalankan seeder untuk mengisi tabel **Roles**:
   ```bash
   php artisan db:seed --class=RolesSeeder
   ```
8. Inject role ke user yang dibuat:
   ```bash
   php artisan tinker
   >>> $u = \App\Models\User::first();
   >>> $u->assignRole('Super Admin');
   >>> exit
   ```
9. Daftarkan **Shield** untuk role Super Admin:
   ```bash
   php artisan shield:super-admin
   php artisan shield:generate --all
   ```
10. Buat storage link (lokal):
    ```bash
    php artisan storage:link
    ```
11. Jalankan server lokal:
    ```bash
    php artisan serve
    ```
    Akses via: `http://127.0.0.1:8000`

---

## 🖇️ Storage Link di Server (Hostinger)

> Jika `php artisan storage:link` gagal karena `exec()` dinonaktifkan, gunakan cara manual berikut.

Jalankan dari **root project**: `/home/u480825811/domains/pitstoppertamina.com/public_html`

```bash
# 1. Masuk ke folder project
cd /home/u480825811/domains/pitstoppertamina.com/public_html

# 2. Pastikan struktur ada
mkdir -p storage/app/public

# 3. Hapus jika ada 'public/storage' yang salah (folder/link lama)
rm -rf public/storage

# 4. Buat symlink RELATIF: public/storage -> ../storage/app/public
cd public
ln -s ../storage/app/public storage

# 5. Verifikasi
ls -l storage
# Output harus: storage -> ../storage/app/public
```

---

## 🔐 SSH Server

```bash
ssh -p 65002 u480825811@46.202.186.223
```

> Setelah login SSH, pastikan perintah di bagian **Storage Link di Server** dijalankan dari direktori project yang benar.
