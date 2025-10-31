<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM gedung");
?>

<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-header bg-gradient-primary text-white">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="m-0"><i class="fas fa-book-reader me-2"></i>data gedung</h5>
        <a href="index.php?halaman=tambahgedung" class="btn btn-light btn-sm">
          <i class="fas fa-plus"></i> Tambah gedung
        </a>
      </div>
    </div>

    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover text-nowrap">
        <thead class="thead-dark">
          <tr class="text-center">
            <th style="width: 5%">NO</th>
            <th>Nama gedung</th>
            <th>kapasitas</th>
            <th>harga</th>
            <th>fasilitas</th>
            <th>foto</th>
            <th style="width: 15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id_gedung = 1;
          while ($data = mysqli_fetch_assoc($query)) {
            // Amankan agar tidak error jika kolom tidak ada
            $nama_gedung = isset($data['nama_gedung']) ? htmlspecialchars($data['nama_gedung']) : '-';
            $kapasitas  = isset($data['kapasitas']) ? htmlspecialchars($data['kapasitas']) : '-';
            $harga   = isset($data['harga']) ? htmlspecialchars($data['harga']) : '-';
            $fasilitas    = isset($data['fasilitas']) ? htmlspecialchars($data['fasilitas']) : '-';
            $foto    = isset($data['foto']) ? htmlspecialchars($data['foto']) : '-';
          ?>
            <tr>
              <td class="text-center"><?= $id_gedung++; ?></td>
              <td><?= $nama_gedung; ?></td>
              <td><?= $kapasitas; ?></td>
              <td><?= $harga; ?></td>
              <td><?= $fasilitas; ?></td>
              <td><?= $foto; ?></td>
              <td class="text-center">
                <a href="index.php?halaman=editgedung&id=<?= $id_gedung_db; ?>" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="hapus_gedung.php?id=<?= $id_gedung_db; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>