# Dokumentasi Singkat dan Pengujian CRUD Perpustakaan

## 1. Deskripsi aplikasi
Aplikasi ini membantu petugas mengelola koleksi buku perpustakaan kampus yang sebelumnya dicatat melalui formulir kertas dan spreadsheet terpisah. Sistem dibuat menggunakan PHP dan MySQL dengan operasi CRUD.

## 2. Rancangan basis data
Database: `db_perpustakaan_kampus`  
Tabel: `buku`

| Field | Tipe data | Keterangan |
|---|---|---|
| `id_buku` | INT | Primary key, auto increment |
| `isbn` | VARCHAR(20) | ISBN unik jika tersedia |
| `judul` | VARCHAR(150) | Wajib diisi |
| `pengarang` | VARCHAR(100) | Wajib diisi |
| `penerbit` | VARCHAR(100) | Opsional |
| `tahun_terbit` | YEAR | Tahun penerbitan |
| `stok` | INT | Wajib, default 0, tidak boleh negatif |
| `lokasi_rak` | VARCHAR(30) | Lokasi buku |

## 3. Implementasi fitur
- **Create:** formulir tambah buku menyimpan data dengan perintah `INSERT` dan prepared statement.
- **Read:** daftar buku ditampilkan berdasarkan judul secara alfabetis. Pencarian mendukung judul, pengarang, dan ISBN.
- **Update:** petugas dapat mengubah informasi buku menggunakan formulir edit dan perintah `UPDATE` berdasarkan ID.
- **Delete:** petugas menghapus data setelah konfirmasi. Permintaan penghapusan menggunakan metode POST.
- **Validasi:** judul dan pengarang wajib diisi, stok harus bilangan bulat nonnegatif, tahun terbit harus berada pada rentang yang valid, dan ISBN tidak boleh duplikat.

## 4. Tabel skenario pengujian
Isi kolom hasil aktual dan status setelah pengujian langsung di komputer. Status di bawah ini adalah hasil yang diharapkan, bukan klaim bahwa pengujian telah dijalankan.

| No. | Skenario | Langkah pengujian | Hasil yang diharapkan | Hasil aktual/status |
|---:|---|---|---|---|
| 1 | Menambah buku valid | Isi judul, pengarang, stok, dan data lain yang diperlukan; klik Simpan Buku | Data tersimpan dan muncul pada daftar | Belum diuji |
| 2 | Membuka daftar buku | Buka halaman utama | Daftar buku tampil dan diurutkan berdasarkan judul | Belum diuji |
| 3 | Mencari berdasarkan judul | Masukkan kata kunci judul pada kolom pencarian | Hanya buku yang cocok ditampilkan | Belum diuji |
| 4 | Mencari berdasarkan pengarang | Cari nama pengarang | Buku dengan pengarang yang cocok ditampilkan | Belum diuji |
| 5 | Mencari berdasarkan ISBN | Masukkan ISBN pada kolom pencarian | Buku dengan ISBN yang cocok ditampilkan | Belum diuji |
| 6 | Mengubah stok | Edit stok buku menjadi angka nonnegatif yang berbeda | Nilai baru tersimpan dan tampil pada daftar | Belum diuji |
| 7 | Menghapus buku | Klik Hapus, lalu setujui konfirmasi | Catatan buku terpilih dihapus | Belum diuji |
| 8 | Stok negatif | Isi stok dengan -1 lalu kirim formulir | Sistem menolak input dan menampilkan pesan validasi | Belum diuji |
| 9 | Judul kosong | Kosongkan judul lalu kirim formulir | Sistem menolak input | Belum diuji |
| 10 | Pengarang kosong | Kosongkan pengarang lalu kirim formulir | Sistem menolak input | Belum diuji |
| 11 | ISBN duplikat | Tambahkan buku dengan ISBN yang sudah ada | Sistem menolak duplikasi dan memberi pesan jelas | Belum diuji |
| 12 | Pencarian tidak ditemukan | Cari kata kunci yang tidak ada | Pesan bahwa data tidak ditemukan tampil | Belum diuji |

## 5. Kesimpulan
Aplikasi menyediakan fungsi dasar pengelolaan koleksi buku melalui operasi CRUD, pencarian tiga bidang, validasi input, dan prepared statement. Pengujian fungsional perlu dijalankan pada lingkungan lokal dan hasil aktual diperbarui sebelum dokumentasi dikumpulkan.

## 6. Dokumentasi tangkapan layar yang perlu dilampirkan
1. Halaman daftar buku dengan beberapa data contoh.
2. Halaman formulir tambah buku.
3. Pesan berhasil setelah menambahkan buku.
4. Halaman edit buku dan hasil perubahan yang tersimpan.
5. Dialog konfirmasi sebelum penghapusan.
6. Daftar buku setelah penghapusan.
7. Pesan validasi ketika stok negatif atau field wajib kosong.
8. Pesan ketika ISBN duplikat dimasukkan.
9. Hasil pencarian berdasarkan judul, pengarang, dan ISBN.

Ambil tangkapan layar dari aplikasi yang benar-benar dijalankan. Jangan mengisi status pengujian sebagai berhasil sebelum hasilnya diperiksa.
