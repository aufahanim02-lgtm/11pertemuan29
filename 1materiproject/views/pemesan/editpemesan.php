<!-- ===========================================================
     HALAMAN EDIT ADMIN
=========================================================== -->
<section class="content">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="row">
                <div class="col">
                    <h5 class="m-0"><i class="fas fa-user-edit me-2"></i> Edit pemesan</h5>
                </div>
                <div class="col text-end">
                    <a href="index.php?halaman=pemesan" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <form action="db/dbpemesan.php?proses=edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_pemesan" value="<?= htmlspecialchars($pemesan['id_pemesan']); ?>">

                <div class="form-group mb-3">
                    <label for="nama_pemesan">nama pemesan</label>
                    <input type="nama_pemesan" class="form-control" id="nama_pemesan" name="nama_pemesan"
                        placeholder="Masukkan nama_pemesan baru">
                </div>

                <div class="form-group mb-3">
                    <label for="desa_pemesan">desa_pemesan</label>
                    <input type="desa_pemesan" class="form-control" id="desa_pemesan" name="desa_pemesan"
                        placeholder="Masukkan desa_pemesan">
                </div>

                <div class="form-group mb-3">
                    <label for="kec_pemesan">kec_pemesan</label>
                    <input type="kec_pemesan" class="form-control" id="kec_pemesan" name="kec_pemesan"
                        placeholder="Masukkan kec_pemesan baru (opsional)">
                </div>

                <div class="form-group mb-3">
                    <label for="hp_pemesan">hp_pemesan</label>
                    <input type="hp_pemesan" class="form-control" id="hp_pemesan" name="hp_pemesan"
                        placeholder="Masukkan hp_pemesan baru (opsional)">
                </div>

                <div class="form-group mb-3">
                    <label for="foto">Foto Admin</label>
                    <div class="mb-2">
                        <img src="<?= $fotoAdmin; ?>" alt="Foto Admin"
                            class="img-thumbnail border"
                            style="width:120px; height:120px; object-fit:cover;">
                    </div>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-warning btn-sm">
                        <i class="fa fa-retweet"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div