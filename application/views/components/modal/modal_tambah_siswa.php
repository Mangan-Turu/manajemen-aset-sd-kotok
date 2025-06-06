<div class="modal fade" id="tambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('siswa/store') ?>" method="post" id="formSiswa">
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
                    <!-- end hidden input -->

                    <div class="form-group col-md-6">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" required placeholder="Masukkan NIS" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" required placeholder="Masukkan Nama Siswa" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" required placeholder="Masukkan Username" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required placeholder="Masukkan Tempat Lahir" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required placeholder="Masukkan Tanggal Lahir" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_ortu">Nama Orang Tua</label>
                        <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" required placeholder="Masukkan Nama Orang Tua" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_hp_ortu">No. Telp Orang Tua</label>
                        <input type="number" class="form-control" name="no_hp_ortu" id="no_hp_ortu" required placeholder="Masukkan No. Telp Orang Tua" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status_aktif">Status</label>
                        <select class="form-control" name="status_aktif" id="status_aktif" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required placeholder="Masukkan Alamat" style="border: 1.5px solid #00AAC1;"></textarea>
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