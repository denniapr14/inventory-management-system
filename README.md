Dokumentasi API dengan Laravel 11 dan Sanctum
Berikut adalah panduan lengkap untuk menginstall API dengan autentikasi Sanctum di Laravel 11, dokumentasi endpoint menggunakan Postman, dan pengaturan proyek GitHub.

1. Install Laravel 11 dan Sanctum
Prasyarat:
PHP 8.2+
Composer
Database (MySQL)

Langkah-langkah:
Buat proyek Laravel baru:

bash
Copy
Download
composer create-project laravel/laravel:^11.0 inventory-api
cd inventory-api
Install Laravel Sanctum:

bash
Copy
Download
composer require laravel/sanctum
Publish file konfigurasi Sanctum:

bash
Copy
Download
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
Jalankan migrasi:

bash
Copy
Download
php artisan migrate
