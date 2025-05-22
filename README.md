🔧 Setup Project Frontend Laravel & Backend CodeIgniter dengan Laragon
Panduan ini menjelaskan langkah-langkah untuk menjalankan proyek frontend Laravel yang terhubung dengan backend CodeIgniter 4 menggunakan Laragon.

🧩 Langkah 1: Clone Project Backend (CodeIgniter 4)
1. Buka terminal pilihanmu (CMD, Git Bash, atau terminal di VS Code).

2. Arahkan ke direktori Laragon, biasanya di:
```
cd C:\laragon\www
```
3. Clonning repository backend
```
git clone https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend.git
```
4. Masuk ke folder backend
```
cd backend
```
5. Jalankan perintah
```
composer install
```

🗃️ Langkah 2: Setup Database & Uji Koneksi API Backend
1. Import Database
Unduh file database dari repo berikut:
Database Sistem KRS[https://github.com/WindyAnggitaPutri/SI_KRS_Database]

2.Buat database baru dengan nama "sikrs"
3. Import file databse yang telah didownload
4. Pastikan Backend berjalan
```
php spark serve

```
5. Buka postman dan uji endpoint nya
```
http://localhost:8080/
```
Kelas:
GET → http://localhost:8080/kelas / http://localhost:8080/kelas/{id}
POST → http://localhost:8080/kelas
PUT → http://localhost:8080/kelas/{id}
DELETE → http://localhost:8080/kelas/{id}

Prodi:
GET → http://localhost:8080/prodi / http://localhost:8080/prodi/{id}
POST → http://localhost:8080/prodi
PUT → http://localhost:8080/prodi/{id}
DELETE → http://localhost:8080/prodi/{id}



📦 Membuat Project Frontend Laravel dengan Laragon
Berikut ini adalah panduan langkah demi langkah untuk membuat project frontend Laravel menggunakan Laragon.

🛠️ Prasyarat
Sebelum memulai, pastikan sudah menginstal:
- Laragon
- Composer
- Git 

🚀 Langkah-langkah
1. Buka Laragon
Jalankan aplikasi Laragon dan pastikan Apache dan MySQL sudah berjalan.
2. Buka Terminal Laragon
Klik kanan pada ikon Laragon di system tray → pilih Terminal.
3. Masuk ke Direktori www
```
cd nama file
```
4. Buat project laravel baru
```
composer create-project laravel/laravel namafile
```
5. 
