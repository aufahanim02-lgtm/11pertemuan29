<?php
// views/kategori/kategori.php
// Pastikan $koneksi sudah tersedia (biasanya di-include di index.php)

// Ambil data dari tabel kategori
$query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori ASC");

// Tambahkan pengecekan error query untuk debugging
if (!$query) {
    // Tampilkan pesan error jika query gagal (berguna saat development)
    die("Query Error: " . mysqli_error($koneksi));
}
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori</h3>
    </div>

    <div class="card card-solid">
        <div class="col">
            <a href="index.php?halaman=tambah_kategori" class="btn btn-primary float-right btn-sm mt-3">
                <i class="fas fa-plus"></i>Kategori
            </a>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama_Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= htmlspecialchars($data['nama_kategori']); ?></td>

                            <td>
                                <a href="index.php?halaman=edit_kategori&id=<?= $data['id_kategori']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="db/dbkategori.php?proses=hapus&namakategori=<?= urlencode($data['nama_kategori']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kategori <?= htmlspecialchars($data['nama_kategori']); ?>?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>