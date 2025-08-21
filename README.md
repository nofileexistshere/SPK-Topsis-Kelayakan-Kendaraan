# 🚗 Sistem Penunjang Keputusan Pemilihan Kendaraan Dinas

### Menggunakan Metode TOPSIS

_PT Telkom Indihome_

## 📘 Deskripsi Proyek

Aplikasi web ini dibangun untuk membantu manajemen PT Telkom Indihome dalam menentukan kendaraan operasional terbaik berdasarkan berbagai kriteria evaluasi. Metode **TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution)** digunakan sebagai dasar pengambilan keputusan karena mampu memberikan solusi alternatif yang paling mendekati ideal.

## 🎯 Tujuan

-   Menyediakan sistem yang cepat dan akurat dalam menilai kelayakan kendaraan.
-   Mendukung pengambilan keputusan berbasis data dan kriteria objektif.
-   Menghindari subjektivitas dalam pemilihan kendaraan operasional.

## 🛠️ Teknologi yang Digunakan

-   **Framework**: Laravel 12 + Laravel Breeze
-   **Frontend**: Blade, TailwindCSS / Bootstrap
-   **Database**: MySQL / MariaDB
-   **Metode**: TOPSIS (Metode Pengambilan Keputusan Multikriteria)
-   **Fitur Tambahan**: Autentikasi, Dashboard Interaktif, Responsive Design

## 🧮 Contoh Kriteria Penilaian

-   Tahun Kendaraan
-   Konsumsi BBM
-   Kapasitas Penumpang
-   Biaya Perawatan
-   Ketersediaan Suku Cadang
-   Harga Kendaraan

## 🚀 Instalasi

```bash
# Clone repositori
git clone https://github.com/username/SPK-Topsis-Kelayakan-Kendaraan.git
cd SPK-Topsis-Kelayakan-Kendaraan

# Install dependency
composer install
npm install && npm run dev

# Salin file environment dan generate key
cp .env.example .env
php artisan key:generate

# Sesuaikan konfigurasi database di file .env lalu jalankan:
php artisan migrate --seed

# Jalankan server lokal
npm run build
php artisan serve
```

## 🔐 Akun Demo

| Role  | Email               | Password |
| ----- | ------------------- | -------- |
| Admin | testuser@telkom.com | 12345678 |

## 🖥️ Fitur Aplikasi

-   ✅ Login & Register
-   ✅ Manajemen Data Alternatif (Kendaraan)
-   ✅ Manajemen Kriteria dan Bobot
-   ✅ Proses Perhitungan TOPSIS Otomatis
-   ✅ Ranking Alternatif Kendaraan
-   ✅ Dashboard Visual Interaktif

## 📂 Struktur Folder Singkat

```
/app
/routes
/resources/views
/database
/public
```

## 🧠 Ringkasan Metode TOPSIS

Metode TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution) bekerja dengan cara:

1. Menyusun Matriks Keputusan
2. Normalisasi Matriks
3. Menentukan Bobot Kriteria
4. Menghitung Solusi Ideal Positif & Negatif
5. Menghitung Jarak ke Solusi Ideal
6. Menghitung Nilai Preferensi dan Ranking

## 📃 Lisensi

Proyek ini ditujukan untuk pengembangan internal atau penelitian akademik di PT Telkom Akses. Untuk kolaborasi atau distribusi, silakan hubungi pengembang.
