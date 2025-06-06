<div class="modal fade" id="tambahMutasi" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('mutasi/tambah_mutasi') ?>" method="post" enctype="multipart/form-data" id="formMutasi">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Mutasi Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id_mutasi" id="id_mutasi" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">

                    <div class="form-group col-md-6">
                        <label for="asset">Asset</label>
                        <select class="form-control" name="asset" id="asset" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">Pilih Asset</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" required placeholder="Masukkan Jumlah Aset" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dari_ruangan">Dari Ruangan</label>
                        <select class="form-control" name="dari_ruangan" id="dari_ruangan" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">Pilih Ruangan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ke_ruangan">Ke Ruangan</label>
                        <select class="form-control" name="ke_ruangan" id="ke_ruangan" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">Pilih Ruangan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="alasan">Alasan</label>
                        <input type="text" class="form-control" name="alasan" id="alasan" required placeholder="Masukkan Alasan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dokumen">Upload Dokumen Pendukung</label>
                        <input type="file" class="form-control" name="dokumen" id="dokumen" accept=".pdf,.jpg,.jpeg,.png" style="border: 1.5px solid #00AAC1;">
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
        get_ruangan: '<?= site_url('option/get_ruangan') ?>'
    };

    function fetchAset() {
        $.ajax({
            url: URL.get_aset,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const $select = $('#asset');
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

    function fetchRuangan(selectId) {
        $.ajax({
            url: URL.get_ruangan,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const $select = $(`#${selectId}`);
                $select.empty().append('<option value="">Pilih Ruangan</option>');
                data.forEach(item => {
                    $select.append(`<option value="${item.id}">${item.nama_ruangan}</option>`);
                });
            },
            error: function() {
                alert('Gagal mengambil data ruangan.');
            }
        });
    }

    function resetFormMutasi() {
        $('#formMutasi')[0].reset();
        $('#mode').val('tambah');
        $('#id_mutasi').val('');
        $('#modalTambahLabel').text('Tambah Mutasi Asset');
    }

    function fillFormMutasi(data) {
        $('#mode').val('edit');
        $('#id_mutasi').val(data.id);
        $('#asset').val(data.aset_id);
        $('#jumlah').val(data.jumlah);
        $('#dari_ruangan').val(data.dari_ruangan_id);
        $('#ke_ruangan').val(data.ke_ruangan_id);
        $('#alasan').val(data.alasan);
        $('#dokumen').val('');
        $('#modalTambahLabel').text('Edit Mutasi Asset');
    }

    fetchAset();
    fetchRuangan('dari_ruangan');
    fetchRuangan('ke_ruangan');

    $('#btnTambahMutasi').click(function() {
        resetFormMutasi();
    });

    $('#datatable-mutasi tbody').on('click', '.btn-edit', function() {
        const row = {
            id: $(this).data('id'),
            aset_id: $(this).data('asset-id'),
            jumlah: $(this).data('jumlah'),
            dari_ruangan_id: $(this).data('dari'),
            ke_ruangan_id: $(this).data('ke'),
            alasan: $(this).data('alasan'),
        };
        fillFormMutasi(row);
        $('#tambahMutasi').modal('show');
    });
</script>