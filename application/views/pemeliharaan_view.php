<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Pemeliharaan Asset</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahPemeliharaan" id="btnTambahPemeliharaan">Tambah Pemeliharaan</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-pemeliharaan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asset</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('components/modal/modal_tambah_pemeliharaan'); ?>

<script>
$(function() {
    var table = $('#datatable-pemeliharaan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('pemeliharaan/get_pemeliharaan') ?>',
            type: 'POST',
        },
        columns: [
            { data: 'no' },
            { data: 'nama_aset' },
            {
                data: null,
                title: 'Jumlah (Satuan)',
                render: function(data, type, row) {
                    return `${row.jumlah} (${row.satuan})`;
                }
            },
            { data: 'tanggal_pemeliharaan' },
            { data: 'jenis_pemeliharaan' },
            { data: 'deskripsi' },
            {
                data: 'biaya',
                render: function(data, type, row) {
                    if (!data) return '-';
                    return 'Rp ' + parseFloat(data).toLocaleString('id-ID');
                }
            },
            {
                data: 'status',
                render: function(data, type, row) {
                    if (data == 0) {
                        return `<button class="btn btn-sm btn-primary btn-status" data-id="${row.id}" data-status="0">Maintenance</button>`;
                    } else {
                        return `<button class="btn btn-sm btn-success" disabled>Selesai</button>`;
                    }
                }
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    let downloadUrl = '<?= base_url('pemeliharaan/download/') ?>' + data;
                    return `
                        <button class="btn btn-sm btn-warning btn-edit" 
                            data-id="${row.id}"
                            data-asset-id="${row.aset_id}"
                            data-jumlah="${row.jumlah}"
                            data-jenis="${row.jenis_pemeliharaan}"
                            data-deskripsi="${row.deskripsi}"
                            data-biaya="${row.biaya}"
                        >Edit</button>
                        <a href="${downloadUrl}" class="btn btn-sm btn-info" target="_blank">Download Doc</a>
                    `;
                }
            }
        ]
    });

    $('#btnTambahPemeliharaan').click(function() {
        $('#tambahPemeliharaan form')[0].reset();
        $('#mode').val('tambah');
        $('#id_pemeliharaan').val('');
    });

    $('#datatable-pemeliharaan tbody').on('click', '.btn-status', function () {
        var btn = $(this);
        var id = btn.data('id');

        if (!confirm('Apakah Anda yakin ingin menyelesaikan pemeliharaan ini?')) return;

        $.ajax({
            url: '<?= base_url('pemeliharaan/update_status') ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                table.ajax.reload(null, false);
            },
            error: function () {
                alert('Terjadi kesalahan saat mengubah status.');
            }
        });
    });

    $('#datatable-pemeliharaan tbody').on('click', '.btn-edit', function() {
        var btn = $(this);
        $('#mode').val('edit');
        $('#id_pemeliharaan').val(btn.data('id'));
        $('#asset_pemeliharaan').val(btn.data('asset-id'));
        $('#jumlah_pemeliharaan').val(btn.data('jumlah'));
        $('#jenis_pemeliharaan').val(btn.data('jenis'));
        $('#deskripsi_pemeliharaan').val(btn.data('deskripsi'));
        $('#biaya_pemeliharaan').val(btn.data('biaya'));
        $('#tambahPemeliharaan').modal('show');
    });
});
</script>
