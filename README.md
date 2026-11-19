# Portal Berita WartaKini (Laravel CRUD)

Aplikasi portal berita berbasis Laravel dengan fitur autentikasi penulis, dasbor redaksi, dan manajemen artikel (CRUD).

## Cara Menjalankan Projek
1. Jalankan `composer install`
2. Salin `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database
3. Jalankan `php artisan key:generate`
4. Jalankan `php artisan migrate:fresh --seed`
5. Jalankan `php artisan serve` dan buka `http://127.0.0.1:8000`

## Akun Demo (Seeder)
- **Email:** `praktikan@example.com`
- **Password:** `password`
