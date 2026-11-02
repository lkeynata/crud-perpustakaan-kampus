CREATE DATABASE IF NOT EXISTS db_perpustakaan_kampus
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_perpustakaan_kampus;

CREATE TABLE IF NOT EXISTS buku (
  id_buku INT AUTO_INCREMENT PRIMARY KEY,
  isbn VARCHAR(20) UNIQUE,
  judul VARCHAR(150) NOT NULL,
  pengarang VARCHAR(100) NOT NULL,
  penerbit VARCHAR(100),
  tahun_terbit YEAR,
  stok INT NOT NULL DEFAULT 0,
  lokasi_rak VARCHAR(30),
  CONSTRAINT chk_stok_nonnegatif CHECK (stok >= 0)
) ENGINE=InnoDB;

INSERT INTO buku (isbn, judul, pengarang, penerbit, tahun_terbit, stok, lokasi_rak) VALUES
('9786020000001', 'Dasar Pemrograman Web', 'A. Pratama', 'Penerbit Kampus', 2025, 8, 'A-03'),
('9786020000002', 'Sistem Basis Data', 'R. Kurniawan', 'Ilmu Media', 2024, 12, 'B-01'),
('9786020000003', 'Analisis dan Perancangan Sistem Informasi', 'D. Puspita', 'Cendekia Press', 2023, 5, 'C-02')
ON DUPLICATE KEY UPDATE judul = VALUES(judul);
