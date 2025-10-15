# Cara Install

1. Buat Folder untuk directory
2. Terminal 'Git Clone https://github.com/randydwisap/pitstop-pertamina/'
3. Terminal 'composer u'
4. Setting database di file .env
5. Terminal 'php artisan migrate'
6. lalu bikin user
7. php artisan make:filament-user
8. lalu bikin jalankan seeder untuk isi tabel Roles
9. php artisan db:seed --class=RolesSeeder
10. lalu inject role ke user yang dibikin
11. php artisan tinker
$u = \App\Models\User::first();
$u->assignRole('Super Admin');
12. php artisan shield:super-admin , untuk daftarkan shield ke role superadmin
13. php artisan shield:generate --all
14. php artisan storage:link
15. php artisan serve untuk run


#untuk php storage link di server
cd /home/u480825811/domains/pitstoppertamina.com/public_html
pastikan struktur ada
mkdir -p storage/app/public
hapus kalau ada 'public/storage' yang salah (folder/old link)
rm -rf public/storage
buat symlink RELATIF: public/storage -> ../storage/app/public
cd public
ln -s ../storage/app/public storage
verifikasi
ls -l storage
harus terlihat: storage -> ../storage/app/public
ini ssh server
ssh -p 65002 u480825811@46.202.186.223