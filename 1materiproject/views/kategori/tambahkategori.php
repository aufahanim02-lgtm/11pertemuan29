<section class="content">
    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h3 class="card-title text-white m-0">Tambah kategori</h3>
        </div>

        <form action="db/dbkategori.php?proses=tambah" method="POST" enctype="multipart/form-data">
            <div class="card-body">

                <div class="form-group mb-3">
                    <label for="nama_kategori" class="fw-bold">Nama_kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Masukkan nama_kategori" required>
                </div>

                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-warning mr-2">
                        <i class="fa fa-retweet"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan pemesan
                    </button>
                </div>
        </form>
    </div>
</section>