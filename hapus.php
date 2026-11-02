<?php
require __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect();
$id = filter_input(INPUT_POST, 'id_buku', FILTER_VALIDATE_INT);
if (!$id || $id < 1) redirect('index.php?status=notfound');
try {
 $stmt = $conn->prepare('DELETE FROM buku WHERE id_buku = ?');
 $stmt->bind_param('i', $id); $stmt->execute();
 $deleted = $stmt->affected_rows; $stmt->close();
 redirect($deleted ? 'index.php?status=deleted' : 'index.php?status=notfound');
} catch (mysqli_sql_exception $e) {
 // Penghapusan dapat ditolak jika catatan terhubung ke transaksi peminjaman.
 redirect('index.php?status=error');
}
