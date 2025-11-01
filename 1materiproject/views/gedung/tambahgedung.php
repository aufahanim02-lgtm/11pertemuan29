<section class="content">
  <div class="card shadow-sm">
    <div class="card-header bg-primary">
      <h3 class="card-title text-white m-0">Tambah gedung</h3>
    </div>

    <form action="db/dbgedung.php?proses=tambah" method="POST" enctype="multipart/form-data">
      <div class="card-body">

        <div class="form-group mb-3">
          <label for="nama_gedung" class="fw-bold">Nama_gedung</label>
          <input type="text" class="form-control" id="nama_gedung" name="nama_gedung"
            placeholder="Masukkan nama gedung" required>
        </div>

        <div class="form-group mb-3">
          <label for="id_kategori" class="fw-bold">id_kategori</label>
          <input type="text" class="form-control" id="id_kategori" name="id_kategori"
            placeholder="Masukkan id_kategori" required>
        </div>

        <div class="form-group mb-3">
          <label for="kapasitas" class="fw-bold">kapasitas</label>
          <input type="text" class="form-control" id="kapasitas" name="kapasitas"
            placeholder="Masukkan kapasitas" required>
        </div>

        <div class="form-group mb-3">
          <label for="harga" class="fw-bold"> harga</label>
          <input type="text" class="form-control" id="harga" name="harga"
            placeholder="Masukkan harga" required>
        </div>

        <div class="form-group mb-3">
          <label for="fasilitas" class="fw-bold">fasilitas</label>
          <input type="text" class="form-control" id="fasilitas" name="fasilitas"
            placeholder="Masukkan fasilitas" required>
        </div>

        <div class="form-group mb-4">
          <label for="foto" class="fw-bold"> foto </label>
          <input type="file" class="form-control mt-2" id="foto" name="foto" accept="image/*">
        </div>

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
