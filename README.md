Cara Install

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
    > > > $u = \App\Models\User::first();
>>> $u->assignRole('Super Admin');
12. php artisan shield:super-admin , untuk daftarkan shield ke role superadmin
13. php artisan shield:generate --all
14. php artisan storage:link
15. php artisan serve untuk run
