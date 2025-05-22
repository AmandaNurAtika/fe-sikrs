# 🚀 SI-KRS Frontend - Laravel + Tailwind CSS
Ini adalah proyek antarmuka pengguna (frontend) berbasis Laravel 10 dan Tailwind CSS yang dirancang untuk terhubung dengan backend REST API (dibangun dengan CodeIgniter 4). Aplikasi ini digunakan untuk mengelola data Mahasiswa, Program Studi (Prodi), dan Kelas.

- Backend[https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend]
- Database[https://github.com/WindyAnggitaPutri/SI_KRS_Database]

# ⚙ Teknologi
- Laravel 10
- Tailwind CSS
- Laravel HTTP Client (untuk konsumsi API)
- Vite (build asset frontend)
- REST API (CodeIgniter 4)

# 🧩 Struktur Sistem
Frontend Laravel ini tidak menyimpan data ke database lokal. Semua proses Create, Read, Update, dan Delete dilakukan melalui REST API backend CodeIgniter.

# 🚀 SETUP BACKEND
1. Clone Repository BE
```
git clone https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend.git
```
```
- cd nama-file
```
2. Install Dependency CodeIgniter
``
composer install
``
4. Copy File Environment
```
cp .env.example .env
```
6. Menjalankan CodeIgniter
```
php spark serve
```
8. Cek EndPoint menggunakan Postman
- Kelas :
```
- GET → http://localhost:8080/kelas / http://localhost:8080/kelas/{id}
- POST → http://localhost:8080/kelas
- PUT → http://localhost:8080/kelas/{id}
- DELETE → http://localhost:8080/kelas/{id}
```
- Prodi :
```
- GET → http://localhost:8080/prodi / http://localhost:8080/prodi/{id}
- POST → http://localhost:8080/prodi
- PUT → http://localhost:8080/prodi/{id}
- DELETE → http://localhost:8080/prodi/{id}
```

# 🚀 SETUP FRONTEND
1. Install Laravel
Install di CMD atau Terminal
```
composer create-priject laravel/laravel nama-project
```

2. Install Dependency Laravel
```
composer install
```
4. Copy File Environment
```
cp .env.example .env
```
6. Set .env untuk Non-Database App
```
APP_NAME=Laravel
APP_URL=http://localhost:8000
SESSION_DRIVER=file
```

8. Cara Menjalankan Laravel server
php artisan serve
