<?php
require __DIR__ . '/config.php';
$q = trim((string)($_GET['q'] ?? ''));
if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare('SELECT id_buku, isbn, judul, pengarang, penerbit, tahun_terbit, stok, lokasi_rak FROM buku WHERE judul LIKE ? OR pengarang LIKE ? OR isbn LIKE ? ORDER BY judul ASC');
    $stmt->bind_param('sss', $like, $like, $like);
} else {
    $stmt = $conn->prepare('SELECT id_buku, isbn, judul, pengarang, penerbit, tahun_terbit, stok, lokasi_rak FROM buku ORDER BY judul ASC');
}
$stmt->execute();
$books = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$flash = (string)($_GET['status'] ?? '');
$messages = [
    'created' => 'Data buku berhasil ditambahkan.',
    'updated' => 'Data buku berhasil diperbarui.',
    'deleted' => 'Data buku berhasil dihapus.',
    'notfound' => 'Data buku tidak ditemukan.',
    'invalid' => 'Data tidak valid. Periksa kembali isian formulir.',
    'duplicate' => 'ISBN sudah digunakan. Gunakan ISBN lain.',
    'error' => 'Operasi gagal dilakukan. Silakan periksa data dan coba kembali.'
];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Perpustakaan Kampus | Data Buku</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar"><div class="brand"><div class="brand-icon">▤</div><div><strong>Perpustakaan Kampus</strong><span>Sistem Informasi Koleksi Buku</span></div></div><span class="top-tag">PANEL PETUGAS</span></header>
<main class="container">
<section class="hero"><div><p class="eyebrow">MANAJEMEN KOLEKSI</p><h1>Data Buku</h1><p class="subtitle">Kelola koleksi buku perpustakaan dalam satu tempat.</p></div><a class="button primary" href="tambah.php">＋ Tambah Buku</a></section>
<?php if (isset($messages[$flash])): ?><div class="alert <?= in_array($flash, ['created','updated','deleted'], true) ? 'success' : 'warning' ?>"><?= e($messages[$flash]) ?></div><?php endif; ?>
<section class="stats"><div class="stat-card"><span>Total judul buku</span><strong><?= count($books) ?><?= $q !== '' ? ' <small>hasil</small>' : '' ?></strong><p><?= $q !== '' ? 'Berdasarkan pencarian' : 'Data sesuai filter saat ini' ?></p></div><div class="stat-card"><span>Fitur tersedia</span><strong>CRUD</strong><p>Tambah, lihat, ubah, dan hapus</p></div><div class="stat-card"><span>Pencarian</span><strong>3 bidang</strong><p>Judul, pengarang, atau ISBN</p></div></section>
<section class="panel"><div class="panel-heading"><div><h2>Daftar koleksi</h2><p>Gunakan kolom pencarian untuk menemukan buku.</p></div><form class="search" method="get" action="index.php"><input type="search" name="q" value="<?= e($q) ?>" placeholder="Cari judul, pengarang, ISBN..."><button class="button dark" type="submit">Cari</button><?php if ($q !== ''): ?><a class="button light" href="index.php">Reset</a><?php endif; ?></form></div>
<div class="table-wrap"><table><thead><tr><th>No.</th><th>Informasi buku</th><th>ISBN</th><th>Tahun</th><th>Stok</th><th>Lokasi rak</th><th>Aksi</th></tr></thead><tbody>
<?php if (!$books): ?><tr><td colspan="7" class="empty">Tidak ada data buku yang cocok.</td></tr><?php else: foreach ($books as $i => $book): ?><tr><td class="muted"><?= $i + 1 ?></td><td><strong><?= e($book['judul']) ?></strong><span class="subcell"><?= e($book['pengarang']) ?><?= $book['penerbit'] ? ' · ' . e($book['penerbit']) : '' ?></span></td><td><?= e($book['isbn'] ?? '-') ?></td><td><?= e((string)($book['tahun_terbit'] ?? '-')) ?></td><td><span class="stock <?= (int)$book['stok'] === 0 ? 'zero' : '' ?>"><?= (int)$book['stok'] ?> eks.</span></td><td><?= e($book['lokasi_rak'] ?? '-') ?></td><td><div class="actions"><a class="action edit" href="edit.php?id=<?= (int)$book['id_buku'] ?>">Edit</a><form method="post" action="hapus.php" onsubmit="return confirm('Yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.');"><input type="hidden" name="id_buku" value="<?= (int)$book['id_buku'] ?>"><button class="action delete" type="submit">Hapus</button></form></div></td></tr><?php endforeach; endif; ?>
</tbody></table></div><div class="table-footer">Menampilkan <?= count($books) ?> data buku<?= $q !== '' ? ' untuk pencarian “' . e($q) . '”' : '' ?>.</div></section>
<footer>CRUD Perpustakaan Kampus <span>·</span> PHP &amp; MySQLi</footer>
</main></body></html>
