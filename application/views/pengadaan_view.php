<div class="row">
    <div class="col">
        <div class="card">
            <?php if ($this->session->userdata('role') === 'admin'): ?>
                <div class="card-header">
                    <h2 class="card-title">Informasi Data Siswa</h2>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahPengadaan" id="btnTambahPengadaan">Download Laporan</button> -->
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahPengadaan" id="btnTambahPengadaan">Tambah Pengadaan</button>
                    </div>
                </div>
            <?php endif ?>
            <div class="card-body">
                <table id="datatable-pengadaan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pengadaan</th>
                            <th>Tanggal</th>
                            <th>Aset</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Sumber Dana</th>
                            <th>Supplier</th>
                            <?php if ($this->session->userdata('role') === 'admin'): ?>
                                <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Load Modal -->
<?php $this->load->view('components/modal/modal_tambah_pengadaan'); ?>
<!-- End Load Modal -->

<!-- Data Table -->
<script>
    const BASE_URL = '<?= base_url() ?>';

    $(function() {
        const columns = [{
                data: 'no'
            },
            {
                data: 'no_pengadaan'
            },
            {
                data: 'tanggal_pengadaan',
                render: function(data) {
                    return moment(data).format('DD/MM/YYYY');
                }
            },
            {
                data: 'aset'
            },
            {
                data: 'jumlah'
            },
            {
                data: 'satuan'
            },
            {
                data: 'harga_satuan'
            },
            {
                data: 'total_harga'
            },
            {
                data: 'sumber_dana'
            },
            {
                data: 'supplier'
            }
        ];

        if (isAdmin) {
            columns.push({
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    const deleteUrl = '<?= base_url('pengadaan/delete/') ?>' + data;
                    return `
                        <button type="button" class="btn btn-sm btn-warning btn-edit"
                            data-id="${data}"
                            data-aset_id="${row.aset_id}"
                            data-jumlah="${row.jumlah}"
                            data-satuan="${row.satuan}"
                            data-harga_satuan="${row.harga_satuan}"
                            data-total_harga="${row.total_harga}"
                            data-sumber_dana="${row.sumber_dana}"
                            data-supplier="${row.supplier}"
                            data-dokumen_pengadaan="${row.dokumen_pengadaan}"
                            data-preview_dokumen="${BASE_URL}${row.dokumen_pengadaan}"
                            data-keterangan="${row.keterangan}"
                            data-tanggal_pengadaan="${moment(row.tanggal_pengadaan).format('YYYY-MM-DD')}"
                            data-toggle="modal"
                            data-target="#tambahPengadaan"
                        >
                            Edit
                        </button>
                        <a href="#" class="btn btn-sm btn-danger btn-confirm-delete" data-url="${deleteUrl}">Batal</a>
                    `;
                }
            });
        }

        $('#datatable-pengadaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pengadaan/get_pengadaan') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>';
                }
            },
            columns: columns
        });
    });

    $(document).on('click', '.btn-edit', function() {
        const fields = ['id', 'aset_id', 'jumlah', 'satuan', 'harga_satuan', 'total_harga', 'sumber_dana', 'supplier', 'dokumen_pengadaan', 'keterangan', 'tanggal_pengadaan'];

        fields.forEach(field => {
            if (field === 'dokumen_pengadaan') {
                const fileName = $(this).attr(`data-${field}`);
                $('#dokumen_pengadaan_preview').html(
                    fileName ?
                    `<small>File sebelumnya: <a href="/uploads/${fileName}" target="_blank">${fileName}</a></small>` :
                    ''
                );
            } else {
                $(`#${field}`).val($(this).attr(`data-${field}`));
            }
        });

        $('#satuanInput').val($(this).attr('data-satuan'));
        $('#suplierInput').val($(this).attr('data-supplier'));
        $('#preview_dokumen').attr('href', $(this).attr('data-preview_dokumen') || '#');

        $('#mode').val('edit');
        $('#modalTambahLabel').text('Edit Pengadaan');
    });

    $(document).on('click', '#btnTambahSiswa', function() {
        resetForm('#formSiswa', 'tambah', '', 'Tambah Pengadaan');
    });

    fetchAset('aset_id');
</script>
<!-- End Data Table -->