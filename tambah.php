<?php
require __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $book = null; require __DIR__ . '/form.php'; exit; }
$book = [
 'isbn' => trim((string)($_POST['isbn'] ?? '')),
 'judul' => trim((string)($_POST['judul'] ?? '')),
 'pengarang' => trim((string)($_POST['pengarang'] ?? '')),
 'penerbit' => trim((string)($_POST['penerbit'] ?? '')),
 'tahun_terbit' => trim((string)($_POST['tahun_terbit'] ?? '')),
 'stok' => trim((string)($_POST['stok'] ?? '0')),
 'lokasi_rak' => trim((string)($_POST['lokasi_rak'] ?? ''))
];
$year = $book['tahun_terbit'] === '' ? null : (int)$book['tahun_terbit'];
$stok = filter_var($book['stok'], FILTER_VALIDATE_INT);
if ($book['judul'] === '' || $book['pengarang'] === '' || $stok === false || $stok < 0 || ($book['tahun_terbit'] !== '' && ($year < 1901 || $year > 2155))) {
 $errorMessage = 'Judul dan pengarang wajib diisi. Stok harus bilangan bulat nonnegatif dan tahun terbit harus valid.'; require __DIR__ . '/form.php'; exit;
}
$isbn = $book['isbn'] === '' ? null : $book['isbn'];
$penerbit = $book['penerbit'] === '' ? null : $book['penerbit'];
$lokasi = $book['lokasi_rak'] === '' ? null : $book['lokasi_rak'];
try {
 $stmt = $conn->prepare('INSERT INTO buku (isbn, judul, pengarang, penerbit, tahun_terbit, stok, lokasi_rak) VALUES (?, ?, ?, ?, ?, ?, ?)');
 $stmt->bind_param('ssssiis', $isbn, $book['judul'], $book['pengarang'], $penerbit, $year, $stok, $lokasi);
 $stmt->execute(); $stmt->close(); redirect('index.php?status=created');
} catch (mysqli_sql_exception $e) {
 if ((int)$e->getCode() === 1062) { $errorMessage = 'ISBN sudah digunakan. Gunakan ISBN lain.'; } else { $errorMessage = 'Data gagal disimpan. Periksa kembali data yang dimasukkan.'; }
 require __DIR__ . '/form.php';
}
