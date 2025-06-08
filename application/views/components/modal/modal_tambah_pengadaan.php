<div class="modal fade" id="tambahPengadaan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= site_url('pengadaan/store') ?>" method="post" id="formPengadaan" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pengadaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <!-- hidden input -->
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="mode" id="mode" value="tambah">
                    <input type="hidden" name="no_pengadaan" value="">
                    <!-- end hidden input -->

                    <div class="form-group col-md-6">
                        <label for="aset_id">Aset</label>
                        <select class="form-control" name="aset_id" id="aset_id" required style="width: 100%; border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Aset --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" min="0" class="form-control" name="jumlah" id="jumlah" required placeholder="Masukkan Jumlah" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_pengadaan">Tanggal Pengadaan</label>
                        <input type="date" class="form-control" name="tanggal_pengadaan" id="tanggal_pengadaan" required placeholder="Masukkan Tanggal Pengadaan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="satuan">Satuan</label>
                        <select class="form-control" id="satuan" style="border: 1.5px solid #00AAC1;" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="unit">Unit</option>
                            <option value="pcs">Pcs</option>
                            <option value="box">Box</option>
                            <option value="Lainnya">Lainnya (input manual)</option>
                        </select>

                        <input type="text" class="form-control mt-2" name="satuan" id="satuanInput" placeholder="Masukkan Satuan" style="border: 1.5px solid #00AAC1; display: none;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="harga_satuan">Masukan Harga Satuan</label>
                        <input type="number" min=0 class="form-control" name="harga_satuan" id="harga_satuan" required placeholder="Masukkan Harga Satuan" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="total_harga">Total Harga</label>
                        <input type="number" min="0" class="form-control" name="total_harga" id="total_harga" required placeholder="Masukkan Total Harga" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sumber_dana">Sumber Dana</label>
                        <input type="text" class="form-control" name="sumber_dana" id="sumber_dana" required placeholder="Masukkan Sumber Data" style="border: 1.5px solid #00AAC1;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="supplier">Suplier</label>

                        <!-- Dropdown kategori -->
                        <select class="form-control" id="supplier" style="border: 1.5px solid #00AAC1;">
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($supliers as $item) : ?>
                                <option value="<?= $item['supplier']; ?>"><?= $item['supplier']; ?></option>
                            <?php endforeach ?>
                            <option value="Lainnya">Lainnya (input manual)</option>
                        </select>

                        <!-- Input manual, sembunyikan dulu -->
                        <input type="text" class="form-control mt-2" name="supplier" id="suplierInput"
                            placeholder="Masukkan Suplier" style="border: 1.5px solid #00AAC1; display: none;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dokumen_pengadaan">Dokumen Pengadaan</label>
                        <input type="file" class="form-control" name="dokumen_pengadaan" id="dokumen_pengadaan" style="border: 1.5px solid #00AAC1;" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="preview_dokumen">Preview</label>
                        <br>
                        <a id="preview_dokumen" target="_blank" href="" class="btn btn-info btn-sm">Preview Dokumen</a>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" style="border: 1.5px solid #00AAC1;"></textarea>
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
    $('#supplier').on('change', function() {
        const val = $(this).val();
        if (val === 'Lainnya') {
            $('#suplierInput ').show().prop('required', true);
        } else {
            $('#suplierInput ').hide().prop('required', false).val(val);
        }
    });

    $('#satuan').on('change', function() {
        const val = $(this).val();
        if (val === 'Lainnya') {
            $('#satuanInput').show().prop('required', true).val('');
        } else {
            $('#satuanInput').hide().prop('required', false).val(val);
        }
    });
</script>