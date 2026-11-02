# Aplikasi CRUD Perpustakaan Kampus

Aplikasi web sederhana untuk mengelola koleksi buku menggunakan PHP, MySQL, dan MySQLi. Fitur mengikuti studi kasus: Create, Read, Update, Delete, pencarian berdasarkan judul/pengarang/ISBN, validasi, prepared statement, serta konfirmasi sebelum menghapus.

## Kebutuhan
- PHP 8.1+ dengan ekstensi `mysqli`
- MySQL 8.0+ atau MariaDB yang kompatibel
- Apache (misalnya melalui XAMPP)

## Cara menjalankan di XAMPP
1. Salin folder `crud_perpustakaan` ke direktori `C:\xampp\htdocs\`.
2. Jalankan modul Apache dan MySQL dari XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`.
4. Pilih menu **Import**, pilih file `database.sql`, lalu jalankan impor. File ini membuat database `db_perpustakaan_kampus`, tabel `buku`, dan tiga contoh data.
5. Pastikan konfigurasi koneksi di `config.php` sesuai dengan MySQL lokal. Konfigurasi bawaan memakai host `localhost`, user `root`, dan password kosong.
6. Buka `http://localhost/crud_perpustakaan/`.

## Struktur file
- `database.sql` — membuat database, tabel, constraint stok, dan contoh data.
- `config.php` — koneksi database, helper escaping HTML, dan redirect.
- `index.php` — daftar buku dan pencarian.
- `tambah.php` — menambahkan buku.
- `edit.php` — mengubah informasi buku.
- `hapus.php` — menghapus buku melalui metode POST.
- `form.php` — formulir tambah/edit.
- `style.css` — antarmuka responsif.
- `DOKUMENTASI_PENGUJIAN.md` — ringkasan fitur dan tabel skenario pengujian.

## Keamanan dan validasi
- Query yang menerima input pengguna menggunakan prepared statement.
- Judul dan pengarang wajib diisi; stok harus bilangan bulat nonnegatif.
- ISBN memiliki constraint `UNIQUE`; duplikasi ditangani dengan pesan yang jelas.
- Output teks ditampilkan melalui `htmlspecialchars` untuk mengurangi risiko XSS.
- Penghapusan dilakukan dengan POST dan meminta konfirmasi di antarmuka.
- Untuk sistem produksi, tambahkan autentikasi petugas, perlindungan CSRF, pencatatan audit, dan pertimbangkan soft delete jika buku terkait transaksi peminjaman.

## Catatan
Tahun terbit menggunakan tipe `YEAR` sesuai rancangan studi kasus. Jika server MySQL yang digunakan berbeda versinya, pastikan dukungan constraint `CHECK` dan tipe `YEAR` sesuai.
