<?php
require __DIR__ . '/config.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id && $_SERVER['REQUEST_METHOD'] === 'POST') $id = filter_input(INPUT_POST, 'id_buku', FILTER_VALIDATE_INT);
if (!$id || $id < 1) redirect('index.php?status=notfound');
$stmt = $conn->prepare('SELECT id_buku, isbn, judul, pengarang, penerbit, tahun_terbit, stok, lokasi_rak FROM buku WHERE id_buku = ?');
$stmt->bind_param('i', $id); $stmt->execute(); $book = $stmt->get_result()->fetch_assoc(); $stmt->close();
if (!$book) redirect('index.php?status=notfound');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { require __DIR__ . '/form.php'; exit; }
$book['isbn'] = trim((string)($_POST['isbn'] ?? ''));
$book['judul'] = trim((string)($_POST['judul'] ?? ''));
$book['pengarang'] = trim((string)($_POST['pengarang'] ?? ''));
$book['penerbit'] = trim((string)($_POST['penerbit'] ?? ''));
$book['tahun_terbit'] = trim((string)($_POST['tahun_terbit'] ?? ''));
$book['stok'] = trim((string)($_POST['stok'] ?? '0'));
$book['lokasi_rak'] = trim((string)($_POST['lokasi_rak'] ?? ''));
$year = $book['tahun_terbit'] === '' ? null : (int)$book['tahun_terbit'];
$stok = filter_var($book['stok'], FILTER_VALIDATE_INT);
if ($book['judul'] === '' || $book['pengarang'] === '' || $stok === false || $stok < 0 || ($book['tahun_terbit'] !== '' && ($year < 1901 || $year > 2155))) {
 $errorMessage = 'Judul dan pengarang wajib diisi. Stok harus bilangan bulat nonnegatif dan tahun terbit harus valid.'; require __DIR__ . '/form.php'; exit;
}
$isbn = $book['isbn'] === '' ? null : $book['isbn'];
$penerbit = $book['penerbit'] === '' ? null : $book['penerbit'];
$lokasi = $book['lokasi_rak'] === '' ? null : $book['lokasi_rak'];
try {
 $stmt = $conn->prepare('UPDATE buku SET isbn = ?, judul = ?, pengarang = ?, penerbit = ?, tahun_terbit = ?, stok = ?, lokasi_rak = ? WHERE id_buku = ?');
 $stmt->bind_param('ssssiisi', $isbn, $book['judul'], $book['pengarang'], $penerbit, $year, $stok, $lokasi, $id);
 $stmt->execute(); $stmt->close(); redirect('index.php?status=updated');
} catch (mysqli_sql_exception $e) {
 $errorMessage = (int)$e->getCode() === 1062 ? 'ISBN sudah digunakan. Gunakan ISBN lain.' : 'Data gagal diperbarui. Periksa kembali data yang dimasukkan.';
 require __DIR__ . '/form.php';
}
