<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Perubahan path include sesuai dengan lokasi file ini (asumsi file ini berada di folder 'db')
include "../koneksi.php";

$proses = isset($_GET['proses']) ? $_GET['proses'] : '';

// --- PROSES TAMBAH DATA gedung ---
if ($proses == 'tambah') {

    // Ambil data dari POST
    $nama_gedung = $_POST['nama_gedung'] ?? '';
    $id_kategori = $_POST['id_kategori'] ?? '';
    $kapasitas  = $_POST['kapasitas'] ?? '';
    $harga   = $_POST['harga'] ?? '';
    $fasilitas   = $_POST['fasilitas'] ?? '';

    // Ambil data Foto
    $foto_name = $_FILES['foto']['name'] ?? '';
    $foto_tmp  = $_FILES['foto']['tmp_name'] ?? '';
    // Ganti ke folder foto gedung Anda yang benar
    $folder    = "../assets/foto_gedung/";

    // Proses upload foto
    if (!empty($foto_name)) {
        // Beri nama unik untuk foto
        $foto_name = time() . '_' . basename($foto_name);
        move_uploaded_file($foto_tmp, $folder . $foto_name);
    } else {
        $foto_name = "";
    }

    // Sanitize data sebelum query (Penting untuk Keamanan!)
    $nama_gedung_clean = mysqli_real_escape_string($koneksi, $nama_gedung);
    $id_kategori_clean = mysqli_real_escape_string($koneksi, $id_kategori);
    $kapasitas_clean  = mysqli_real_escape_string($koneksi, $kapasitas);
    $harga_clean   = mysqli_real_escape_string($koneksi, $harga);
    $fasilitas_clean   = mysqli_real_escape_string($koneksi, $fasilitas);
    $foto_name_clean    = mysqli_real_escape_string($koneksi, $foto_name);

    // Simpan ke database
    $query = "INSERT INTO gedung (nama_gedung, id_kategori, kapasitas, harga, fasilitas, foto)
    VALUES ('$nama_gedung_clean', '$id_kategori_clean', '$kapasitas_clean', '$harga_clean', '$fasilitas_clean', '$foto_name_clean')";

    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    // Redirect setelah berhasil
    echo "<script>
            alert('Data gedung berhasil ditambahkan!');
            window.location='../index.php?halaman=gedung';
          </script>";
    exit;

// --- PROSES EDIT DATA gedung ---
} elseif ($proses == 'edit') {

    if (!isset($_POST['id_gedung'])) {
        die("Error: id_gedung tidak ditemukan di form edit!");
    }

    // Ambil data dari POST
    $nama_gedung = $_POST['nama_gedung'];
    $id_kategori = $_POST['id_kategori'];
    $kapasitas = $_POST['kapasitas'];
    $harga  = $_POST['harga'];
    $fasilitas   = $_POST['fasilitas'];

    $foto_name = $_FILES['foto']['name'] ?? '';
    $foto_tmp  = $_FILES['foto']['tmp_name'] ?? '';
    // Ganti ke folder foto gedung Anda yang benar
    $folder    = "../assets/foto_gedung/";

    // Ambil data lama (untuk hapus foto lama)
    $old_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM gedung WHERE id_gedung='$id_gedung'"));

    // Jika upload foto baru
    if (!empty($foto_name)) {
        // Beri nama unik untuk foto
        $foto_name = time() . '_' . basename($foto_name);
        move_uploaded_file($foto_tmp, $folder . $foto_name);

        // Hapus foto lama jika ada
        if (!empty($old_data['foto']) && file_exists($folder . $old_data['foto'])) {
            unlink($folder . $old_data['foto']);
        }

        $foto_query = ", foto='".mysqli_real_escape_string($koneksi, $foto_name)."'";
    } else {
        $foto_query = "";
    }

    // Sanitize data teks sebelum query
    $nama_gedung_clean = mysqli_real_escape_string($koneksi, $nama_gedung);
    $id_kategori_clean = mysqli_real_escape_string($koneksi, $id_kategori);
    $kapasitas_clean  = mysqli_real_escape_string($koneksi, $kapasitas);
    $harga_clean   = mysqli_real_escape_string($koneksi, $harga);
    $fasilitas_clean   = mysqli_real_escape_string($koneksi, $fasilitas);
    $foto_clean   = mysqli_real_escape_string($koneksi, $foto);

    // Update data
    $query = "UPDATE gedung SET 
                nama_gedung='$nama_gedung_clean',
                id_kategori='$id_kategori_clean',
                kapasitas='$kapasitas_clean',
                harga='$harga_clean'
                fasilitasa='$fasilitasa_clean'
                $foto_query
              WHERE id_gedung='$id_gedung_clean'";
    
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    // Redirect setelah berhasil
    echo "<script>
            alert('Data gedung berhasil diupdate!');
            window.location='../index.php?halaman=gedung';
          </script>";
    exit;

// --- PROSES HAPUS DATA gedung ---
} elseif ($proses == 'hapus') {

    if (!isset($_GET['id_gedung'])) {
        die("Error: id_gedung tidak ditemukan!");
    }

    $id_gedung = $_GET['id_gedung'];
    // Ganti ke folder foto gedung Anda yang benar
    $folder     = "../assets/foto_gedung/";

    // Hapus data transaksi/reservasi yang berelasi (JIKA ADA RELASI)
    // Asumsi: Ada tabel 'reservasi' yang berelasi dengan 'gedung' melalui 'id_gedung'
    mysqli_query($koneksi, "DELETE FROM reservasi WHERE id_gedung='".mysqli_real_escape_string($koneksi, $id_gedung)."'") or die(mysqli_error($koneksi));

    // Ambil nama foto lama
    $get_foto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM gedung WHERE id_gedung='".mysqli_real_escape_string($koneksi, $id_gedung)."'"));
    if (!empty($get_foto['foto']) && file_exists($folder . $get_foto['foto'])) {
        unlink($folder . $get_foto['foto']); // hapus file foto
    }

    // Hapus data gedung
    mysqli_query($koneksi, "DELETE FROM gedung WHERE id_gedung='".mysqli_real_escape_string($koneksi, $id_gedung)."'") or die(mysqli_error($koneksi));

    echo "<script>
            alert('Data gedung dan data reservasi terkait berhasil dihapus!');
            window.location='../index.php?halaman=gedung';
          </script>";
    exit;

} else {
    // Proses tidak dikenali
    die("Error: proses tidak dikenali!");
}
?>