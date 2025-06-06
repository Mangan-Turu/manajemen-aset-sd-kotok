<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Mutasi Asset</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahMutasi" id="btnTambahMutasi">Tambah Mutasi</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-mutasi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asset</th>
                            <th>Jumlah</th>
                            <th>Dari Ruangan</th>
                            <th>Ke Ruangan</th>
                            <th>Tanggal</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('modal_tambah_mutasi'); ?>

<script>
$(function() {
    var table = $('#datatable-mutasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('mutasi/get_mutasi') ?>',
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
            { data: 'dari_ruangan' },
            { data: 'ke_ruangan' },
            { data: 'tanggal_mutasi' },
            { data: 'alasan' },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    let downloadUrl = '<?= base_url('mutasi/download/') ?>' + data;
                    return `
                        <button class="btn btn-sm btn-warning btn-edit" 
                            data-id="${row.id}"
                            data-asset-id="${row.aset_id}"
                            data-jumlah="${row.jumlah}"
                            data-dari="${row.dari_ruangan_id}"
                            data-ke="${row.ke_ruangan_id}"
                            data-alasan="${row.alasan}"
                        >Edit</button>
                        <a href="${downloadUrl}" class="btn btn-sm btn-info" target="_blank">Download Doc</a>
                    `;
                }
            }
        ]
    });

    $('#btnTambahMutasi').click(function() {
        $('#tambahMutasi form')[0].reset();
        $('#mode').val('tambah');
        $('#id_mutasi').val('');
    });

    $('#datatable-mutasi tbody').on('click', '.btn-edit', function() {
        var btn = $(this);
        $('#mode').val('edit');
        $('#id_mutasi').val(btn.data('id'));
        $('#asset').val(btn.data('asset-id'));
        $('#jumlah').val(btn.data('jumlah'));
        $('#dari_ruangan').val(btn.data('dari'));
        $('#ke_ruangan').val(btn.data('ke'));
        $('#alasan').val(btn.data('alasan'));
        $('#tambahMutasi').modal('show');
    });
});
</script>
