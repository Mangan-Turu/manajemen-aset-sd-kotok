<div class="modal fade" id="tambahPengguna" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('pengguna/store_pengguna') ?>" method="post" id="formPengguna">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <!-- hidden input -->
                    <input type="hidden" name="id_pengguna" id="id_pengguna" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">
                    <!-- end hidden input -->

                    <div class="form-group col-md-6">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" required placeholder="Masukkan Nama Lengkap" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_hp">No. Telp</label>
                        <input type="number" class="form-control" name="no_hp" id="no_hp" required placeholder="Masukkan Nomor HP" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required placeholder="Masukkan Username" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ke_ruangan">Pilih Role</label>
                        <select class="form-control" name="role" id="role" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="kepala_sekolah">Kepala Sekolah</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required placeholder="Masukkan Email" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required placeholder="Masukkan Password" style="border: 1.5px solid #00AAC1;">
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