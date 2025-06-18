# Sistem Informasi Manajemen Layanan Kunjungan (SIM-LVK) Rutan

Aplikasi web ini dibangun untuk mendigitalisasi dan mengelola proses layanan kunjungan bagi warga binaan di Rutan. Tujuannya adalah untuk meningkatkan efisiensi, transparansi, dan akurasi data, baik untuk pengunjung maupun untuk staf Rutan.

Aplikasi ini dikembangkan menggunakan **Laravel 10** dan mencakup alur kerja lengkap mulai dari pendaftaran pengunjung, pengajuan jadwal, verifikasi oleh staf, hingga pelaporan.

## ✨ Fitur Utama

### Untuk Pengunjung:
- 🔐 **Autentikasi:** Registrasi dan Login akun.
- 📝 **Pengajuan Kunjungan:** Mengisi form untuk mengajukan jadwal kunjungan, memilih warga binaan, dan mengunggah dokumen (KTP).
- 📅 **Riwayat & Status:** Melihat dashboard personal yang berisi riwayat semua pengajuan beserta statusnya (Menunggu, Disetujui, Ditolak) lengkap dengan ikon.
- 📄 **Bukti Kunjungan:** Mengunduh bukti persetujuan dalam format PDF jika kunjungan disetujui.
-  smartest **Validasi Cerdas:** Sistem secara otomatis akan memblokir pengajuan di hari libur, weekend, atau jika kuota kunjungan mingguan untuk seorang warga binaan sudah penuh.

### Untuk Staf Rutan (Admin):
- 🛡️ **Panel Admin Aman:** Halaman admin terpisah yang dilindungi oleh role-based access.
- 📊 **Dashboard Informatif:** Menampilkan statistik penting seperti jumlah pengajuan baru, kunjungan hari ini, dan total warga binaan.
- ✅ **Verifikasi Kunjungan:** Melihat detail pengajuan, termasuk foto KTP, dan melakukan aksi **Setujui** atau **Tolak**.
- 🗂️ **Manajemen Data Master:** Fitur CRUD (Create, Read, Update, Delete) yang lengkap untuk data **Warga Binaan** dan **Kamar/Blok**.
- 📅 **Manajemen Hari Libur:** Staf dapat menentukan hari-hari libur nasional atau acara khusus.
- 📈 **Laporan Periodik:** Membuat laporan kunjungan berdasarkan rentang tanggal (mingguan/bulanan) dan mengekspornya ke format PDF.

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 8.1+, Laravel 10
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Library Utama:**
  - `laravel/breeze` untuk autentikasi.
  - `barryvdh/laravel-dompdf` untuk pembuatan PDF.
  - `maatwebsite/excel` untuk ekspor laporan ke Excel (opsional).
  - `sweetalert2` untuk notifikasi modern.
  - `flatpickr` untuk pemilih tanggal.

## 🚀 Panduan Instalasi Lokal

Berikut adalah cara untuk menjalankan proyek ini di komputermu sendiri.

### Prasyarat
- PHP (versi 8.1 atau lebih tinggi)
- Composer
- Node.js & NPM
- Server Lokal (XAMPP, Laragon, dll) dengan database MySQL

### Langkah-langkah Instalasi
1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/NAMA_USER_GITHUB_KAMU/NAMA_REPO_KAMU.git](https://github.com/NAMA_USER_GITHUB_KAMU/NAMA_REPO_KAMU.git)
    ```

2.  **Masuk ke direktori proyek:**
    ```bash
    cd nama-repo-kamu
    ```

3.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

4.  **Salin file environment:**
    ```bash
    cp .env.example .env
    ```

5.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi file `.env`:**
    Buka file `.env` dan sesuaikan koneksi database-mu.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_simlvk_rutan  // Pastikan nama database ini sudah kamu buat
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Jalankan migrasi dan seeder:**
    Perintah ini akan membuat semua tabel dan mengisinya dengan data awal (user admin, kamar, dan warga binaan dummy).
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```

9.  **Install dependensi JavaScript:**
    ```bash
    npm install
    ```

10. **Compile aset frontend:**
    ```bash
    npm run dev
    ```
    *(Biarkan terminal ini tetap berjalan saat development)*

11. **Jalankan server development:**
    Buka terminal baru dan jalankan:
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang bisa diakses di `http://127.0.0.1:8000`.

### Akun Default
Setelah menjalankan seeder, kamu bisa login menggunakan akun default berikut:

-   **Role Staf/Admin:**
    -   **Email:** `staf@rutanbatam.com`
    -   **Password:** `pilat123`
-   **Role Pengunjung:**
    -   **Email:** `pengunjung@gmail.com`
    -   **Password:** `sistempeminjamanalat`

---
*Proyek ini dibuat sebagai bagian dari proses belajar pengembangan web dengan Laravel 10.*
