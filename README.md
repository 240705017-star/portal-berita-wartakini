# Portal Berita WartaKini (Laravel CRUD)

Aplikasi portal berita berbasis Laravel dengan fitur autentikasi penulis, dasbor redaksi, dan manajemen artikel (CRUD).

## Cara Cepat Menjalankan Projek

```bash
git clone https://github.com/240705017-star/portal-berita-wartakini.git
cd portal-berita-wartakini
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Setelah server berjalan, buka http://127.0.0.1:8000 di browser.

## Akun Demo (Seeder)
- Email: praktikan@example.com
- Password: password
