<div class="modal fade" id="tambahRuangan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('ruangan/store') ?>" method="post" id="formRuangan">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <!-- hidden input -->
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">
                    <input type="hidden" name="kode_ruangan" id="kode_ruangan">
                    <!-- end hidden input -->

                    <div class="form-group col-md-6">
                        <label for="nama_ruangan">Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" required placeholder="Masukkan Nama Ruangan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jenis_ruangan">Jenis Ruangan</label>
                        <select class="form-control" name="jenis_ruangan" id="jenis_ruangan" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Jenis Ruangan --</option>                            
                            <option value="kelas">Kelas</option>
                            <option value="kantor">Kantor</option>
                            <option value="perpustakaan">Perpustakaan</option>
                            <option value="gudang">Gudang</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lantai">Lantai Ruangan</label>
                        <input type="text" class="form-control" name="lantai" id="lantai" required placeholder="Masukkan Lantai" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kapasitas">Kapasitas Ruangan</label>
                        <input type="text" class="form-control" name="kapasitas" id="kapasitas" required placeholder="Masukkan Kapasitas Ruangan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" required placeholder="Masukkan Penanggung Jawab" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="keterangan">Deskripsi</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" required placeholder="Masukkan Deskripsi Ruangan" style="border: 1.5px solid #00AAC1;">
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