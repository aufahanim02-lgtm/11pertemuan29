<?php
// db/dbkategori.php - File Pemroses Data Kategori

// Ambil parameter proses dari URL
$proses = $_GET['proses'];

// Include file koneksi.php (Asumsi berada satu level di atas folder db/)
include "../koneksi.php";

// Mulai session (diperlukan jika Anda ingin mengaktifkan kembali blok login/session)
session_start();

// Blok yang di-comment out terkait login dapat diaktifkan kembali jika diperlukan
// include "../library/liblogin.php";
// if (ceklogin()) {

if ($proses == 'tambah') {
    // Ambil dan bersihkan data input
    // Asumsi: Form menggunakan input name="nama_kategori"
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

    $sql = "INSERT INTO kategori (nama_kategori) 
            VALUES ('$nama_kategori')";

    if (mysqli_query($koneksi, $sql)) {
        // Berhasil
        header("location:../index.php?halaman=kategori&pesan=tambahberhasil");
    } else {
        // Gagal
        header("location:../index.php?halaman=tambahkategori&pesan=gagal&error=" . mysqli_error($koneksi));
    }
    
// --- PROSES EDIT DATA PEMESAN ---
} elseif ($proses == 'edit') {

    if (!isset($_POST['id_kategori'])) {
        die("Error: id_kategori tidak ditemukan di form edit!");
    }

    // Ambil data dari POST
    $id_kategori   = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    
    $foto_name = $_FILES['foto']['name'] ?? '';
    $foto_tmp  = $_FILES['foto']['tmp_name'] ?? '';
    // Ganti ke folder foto kategori Anda yang benar
    $folder    = "../assets/foto_kategori/";

    // Ambil data lama (untuk hapus foto lama)
    $old_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM kategori WHERE id_kategori='$id_kategori'"));

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
    $nama_kategori_clean = mysqli_real_escape_string($koneksi, $nama_kategori);
    
    // Update data
    $query = "UPDATE kategori SET 
                nama_kategori='$nama_kategori_clean',
                $foto_query
              WHERE id_kategori='$id_kategori_clean'";
               
    // Redirect setelah berhasil
    echo "<script>
            alert('Data kategori berhasil diupdate!');
            window.location='../index.php?halaman=kategori';
          </script>";
    exit;


} elseif ($proses == 'hapus') {
    // Ambil ID dari URL GET
    // Asumsi: Link hapus menggunakan id_kategori
    $id_kategori = mysqli_real_escape_string($koneksi, $_GET['id_kategori']);
    
    // Perhatian! Jika kategori memiliki relasi ke tabel 'bantuan', 
    // penghapusan langsung (DELETE) akan menyebabkan Foreign Key Error.
    // Jika itu terjadi, Anda harus menghapus data di tabel 'bantuan' yang terkait dulu,
    // atau menggunakan Soft Delete jika tabel kategori Anda memilikinya.

    $sql = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";
    
    if (mysqli_query($koneksi, $sql)) {
        // Berhasil
        header("location:../index.php?halaman=kategori&pesan=hapusberhasil");
    } else {
        // Gagal (kemungkinan Foreign Key Constraint)
        header("location:../index.php?halaman=kategori&pesan=gagalhapus&error=" . mysqli_error($koneksi));
    }
}

// Redirect default jika tidak ada proses yang dieksekusi
header("location:../index.php?halaman=kategori");
// } else {
//     header("location: ../login.php");
// }
exit();
?>
