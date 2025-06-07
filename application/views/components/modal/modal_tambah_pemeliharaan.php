<div class="modal fade" id="tambahPemeliharaan" tabindex="-1" role="dialog" aria-labelledby="modalTambahPemeliharaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('Pemeliharaan/tambah_pemeliharaan') ?>" method="post" enctype="multipart/form-data" id="formPemeliharaan">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPemeliharaanLabel">Tambah Pemeliharaan Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id_pemeliharaan" id="id_pemeliharaan" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">

                    <div class="form-group col-md-6">
                        <label for="asset_pemeliharaan">Asset</label>
                        <select class="form-control" name="asset_pemeliharaan" id="asset_pemeliharaan" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">Pilih Asset</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah_pemeliharaan" id="jumlah_pemeliharaan" required placeholder="Masukkan Jumlah Aset" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control" name="jenis_pemeliharaan" id="jenis_pemeliharaan" required placeholder="Masukkan Jenis Pemeliharaan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi_pemeliharaan" id="deskripsi_pemeliharaan" required placeholder="Masukkan Deskripsi Pemeliharaan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="biaya">Biaya</label>
                        <input type="number" class="form-control" name="biaya_pemeliharaan" id="biaya_pemeliharaan" required placeholder="Masukkan Biaya Pemeliharaan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dokumen">Upload Dokumen Pendukung</label>
                        <input type="file" class="form-control" name="dokumen_pemeliharaan" id="dokumen_pemeliharaan" accept=".pdf,.jpg,.jpeg,.png" style="border: 1.5px solid #00AAC1;">
                        <small class="form-text text-muted">Format: PDF, JPG, PNG. Max 2MB. <br>
                        *Kosongkan jika tidak ingin mengubah dokumen saat edit.</small>
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

<script>
    const URL = {
        get_aset: '<?= site_url('option/get_aset') ?>',
    };

    function fetchAset() {
        $.ajax({
            url: URL.get_aset,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const $select = $('#asset_pemeliharaan');
                $select.empty().append('<option value="">Pilih Asset</option>');
                data.forEach(item => {
                    $select.append(`<option value="${item.id}">${item.nama_aset}</option>`);
                });
            },
            error: function() {
                alert('Gagal mengambil data aset.');
            }
        });
    }

    function resetFormPemeliharaan() {
        $('#formPemeliharaan')[0].reset();
        $('#mode').val('tambah');
        $('#id_pemeliharaan').val('');
        $('#modalTambahPemeliharaanLabel').text('Tambah Pemeliharaan Asset');
    }

    function fillFormPemeliharaan(data) {
        $('#mode').val('edit');
        $('#id_pemeliharaan').val(data.id);
        $('#asset_pemeliharaan').val(data.aset_id);
        $('#jumlah_pemeliharaan').val(data.jumlah);
        $('#jenis_pemeliharaan').val(data.jenis_pemeliharaan);
        $('#deskripsi_pemeliharaan').val(data.deskripsi_pemeliharaan);
        $('#biaya_pemeliharaan').val(data.biaya_pemeliharaan);
        $('#dokumen_pemeliharaan').val('');
        $('#modalTambahPemeliharaanLabel').text('Edit Pemeliharaan Asset');
    }

    fetchAset();

    $('#btnTambahPemeliharaan').click(function() {
        resetFormPemeliharaan();
    });

    $('#datatable-pemeliharaan tbody').on('click', '.btn-edit', function() {
        const row = {
            id: $(this).data('id'),
            aset_id: $(this).data('asset-id'),
            jumlah: $(this).data('jumlah'),
            jenis_pemeliharaan: $(this).data('jenis'),
            deskripsi_pemeliharaan: $(this).data('deskripsi'),
            biaya_pemeliharaan: $(this).data('biaya'),
        };
        fillFormPemeliharaan(row);
        $('#tambahPemeliharaan').modal('show');
    });
</script>