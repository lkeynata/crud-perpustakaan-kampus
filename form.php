<?php
// Template formulir dipakai oleh tambah.php dan edit.php.
$isEdit = isset($book);
$actionTitle = $isEdit ? 'Edit Buku' : 'Tambah Buku';
$submitLabel = $isEdit ? 'Simpan Perubahan' : 'Simpan Buku';
$book = $book ?? ['isbn'=>'','judul'=>'','pengarang'=>'','penerbit'=>'','tahun_terbit'=>'','stok'=>0,'lokasi_rak'=>''];
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= e($actionTitle) ?> | Perpustakaan Kampus</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><a class="brand brand-link" href="index.php"><div class="brand-icon">▤</div><div><strong>Perpustakaan Kampus</strong><span>Sistem Informasi Koleksi Buku</span></div></a><span class="top-tag">PANEL PETUGAS</span></header>
<main class="container form-container"><a class="back-link" href="index.php">← Kembali ke daftar buku</a><section class="form-panel"><div class="form-heading"><p class="eyebrow">FORMULIR KOLEKSI</p><h1><?= e($actionTitle) ?></h1><p class="subtitle"><?= $isEdit ? 'Perbarui informasi buku yang dipilih.' : 'Masukkan informasi buku baru ke dalam koleksi.' ?></p></div>
<?php if (!empty($errorMessage)): ?><div class="alert warning"><?= e($errorMessage) ?></div><?php endif; ?>
<form method="post" class="book-form" action="<?= $isEdit ? 'edit.php?id=' . (int)$book['id_buku'] : 'tambah.php' ?>">
<?php if ($isEdit): ?><input type="hidden" name="id_buku" value="<?= (int)$book['id_buku'] ?>"><?php endif; ?>
<div class="field"><label for="judul">Judul buku <em>*</em></label><input id="judul" name="judul" maxlength="150" required value="<?= e($book['judul']) ?>" placeholder="Contoh: Dasar Pemrograman Web"></div>
<div class="field"><label for="pengarang">Pengarang <em>*</em></label><input id="pengarang" name="pengarang" maxlength="100" required value="<?= e($book['pengarang']) ?>" placeholder="Nama pengarang"></div>
<div class="field"><label for="isbn">ISBN</label><input id="isbn" name="isbn" maxlength="20" value="<?= e($book['isbn']) ?>" placeholder="Nomor ISBN (jika tersedia)"><small>ISBN harus unik jika diisi.</small></div>
<div class="field"><label for="penerbit">Penerbit</label><input id="penerbit" name="penerbit" maxlength="100" value="<?= e($book['penerbit']) ?>" placeholder="Nama penerbit"></div>
<div class="field"><label for="tahun_terbit">Tahun terbit</label><input id="tahun_terbit" name="tahun_terbit" type="number" min="1901" max="2155" value="<?= e((string)$book['tahun_terbit']) ?>" placeholder="Contoh: 2025"></div>
<div class="field"><label for="stok">Stok (eksemplar) <em>*</em></label><input id="stok" name="stok" type="number" min="0" max="2147483647" required value="<?= e((string)$book['stok']) ?>"><small>Stok tidak boleh bernilai negatif.</small></div>
<div class="field field-full"><label for="lokasi_rak">Lokasi rak</label><input id="lokasi_rak" name="lokasi_rak" maxlength="30" value="<?= e($book['lokasi_rak']) ?>" placeholder="Contoh: A-03"></div>
<div class="form-actions"><a class="button light" href="index.php">Batal</a><button class="button primary" type="submit"><?= e($submitLabel) ?></button></div>
</form></section><footer>CRUD Perpustakaan Kampus <span>·</span> PHP &amp; MySQLi</footer></main></body></html>
