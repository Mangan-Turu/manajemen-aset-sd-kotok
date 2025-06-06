<div class="modal fade" id="tambahAset" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('aset/store') ?>" method="post" id="formAset">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <!-- hidden input -->
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">
                    <!-- end hidden input -->

                    <div class="form-group col-md-6">
                        <label for="nama_aset">Nama Aset</label>
                        <input type="text" class="form-control" name="nama_aset" id="nama_aset" required placeholder="Masukkan Nama Aset" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" required placeholder="Masukkan Kategori" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" name="merk" id="merk" required placeholder="Masukkan Merk" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipe">Tipe</label>
                        <input type="text" class="form-control" name="tipe" id="tipe" required placeholder="Masukkan Tipe" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="spesifikasi">Spesifikiasi</label>
                        <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" required placeholder="Masukkan Spesifikasi" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Qty</label>
                        <input type="number" min="0" class="form-control" name="jumlah" id="jumlah" required placeholder="Masukkan Jumlah" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="satuan">Qty</label>
                        <input type="text" min="0" class="form-control" name="satuan" id="satuan" required placeholder="Masukkan Satuan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lokasi_fisik">Lokasi Fisik</label>
                        <input type="text" min="0" class="form-control" name="lokasi_fisik" id="lokasi_fisik" required placeholder="Masukkan Lokasi Fisik" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ruangan_id">Ruangan</label>
                        <select class="form-control" name="ruangan_id" id="ruangan_id" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tahun_perolehan">Tahun Perolehan</label>
                        <input type="year" class="form-control" name="tahun_perolehan" id="tahun_perolehan" required placeholder="Masukkan Tahun Perolehan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sumber_dana">Sumber Dna</label>
                        <input type="text" class="form-control" name="sumber_dana" id="sumber_dana" required placeholder="Masukkan Sumber Dana" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input type="number" class="form-control" name="harga_satuan" id="harga_satuan" required placeholder="Masukkan Harga Satuan" style="border: 1.5px solid #00AAC1;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btnSimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnBatal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>