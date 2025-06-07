<div class="modal fade" id="tambahKerusakan" tabindex="-1" role="dialog" aria-labelledby="modalTambahKerusakanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('kerusakan/tambah_kerusakan') ?>" method="post" enctype="multipart/form-data" id="formkerusakan">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKerusakanLabel">Tambah Kerusakan Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id_kerusakan" id="id_kerusakan" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">

                    <div class="form-group col-md-6">
                        <label for="asset_kerusakan">Asset</label>
                        <select class="form-control" name="asset_kerusakan" id="asset_kerusakan" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">Pilih Asset</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah_kerusakan" id="jumlah_kerusakan" required placeholder="Masukkan Jumlah Aset" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi_kerusakan" id="deskripsi_kerusakan" required placeholder="Masukkan Deskripsi kerusakan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dokumen">Upload Dokumen Pendukung</label>
                        <input type="file" class="form-control" name="dokumen_kerusakan" id="dokumen_kerusakan" accept=".pdf,.jpg,.jpeg,.png" style="border: 1.5px solid #00AAC1;">
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
                const $select = $('#asset_kerusakan');
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

    function resetFormKerusakan() {
        $('#formkerusakan')[0].reset();
        $('#mode').val('tambah');
        $('#id_kerusakan').val('');
        $('#modalTambahKerusakanLabel').text('Tambah kerusakan Asset');
    }

    function fillFormKerusakan(data) {
        $('#mode').val('edit');
        $('#id_kerusakan').val(data.id);
        $('#asset_kerusakan').val(data.aset_id);
        $('#jumlah_kerusakan').val(data.jumlah);
        $('#deskripsi_kerusakan').val(data.deskripsi_kerusakan);
        $('#dokumen_kerusakan').val('');
        $('#modalTambahKerusakanLabel').text('Edit kerusakan Asset');
    }

    fetchAset();

    $('#btnTambahKerusakan').click(function() {
        resetFormKerusakan();
    });

    $('#datatable-kerusakan tbody').on('click', '.btn-edit', function() {
        const row = {
            id: $(this).data('id'),
            aset_id: $(this).data('asset-id'),
            jumlah: $(this).data('jumlah'),
            jenis_kerusakan: $(this).data('jenis'),
            deskripsi_kerusakan: $(this).data('deskripsi'),
            biaya_kerusakan: $(this).data('biaya'),
        };
        fillFormKerusakan(row);
        $('#tambahKerusakan').modal('show');
    });
</script>