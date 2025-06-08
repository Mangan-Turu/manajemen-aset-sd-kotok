<div class="row">
    <div class="col">
        <div class="card">
            <?php if ($this->session->userdata('role') === 'admin'): ?>
                <div class="card-header">
                    <h2 class="card-title">Informasi Data Kerusakan Asset</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahKerusakan" id="btnTambahKerusakan">Tambah Kerusakan</button>
                    </div>
                </div>
            <?php endif ?>
            <div class="card-body">
                <table id="datatable-kerusakan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asset</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
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

<?php $this->load->view('components/modal/modal_tambah_kerusakan'); ?>

<script>
    const columns = [{
            data: 'no'
        },
        {
            data: 'nama_aset'
        },
        {
            data: null,
            title: 'Jumlah (Satuan)',
            render: function(data, type, row) {
                return `${row.jumlah} (${row.satuan})`;
            }
        },
        {
            data: 'tanggal_kerusakan',
            render: function(data) {
                return moment(data).format('DD/MM/YYYY');
            }
        },
        {
            data: 'deskripsi'
        },
    ];

    if (isAdmin) {
        columns.push({
            data: 'id',
            orderable: false,
            searchable: false,
            className: 'text-end',
            render: function(data, type, row) {
                let downloadUrl = '<?= base_url('kerusakan/download/') ?>' + data;
                return `
                    <button class="btn btn-sm btn-warning btn-edit" 
                        data-id="${row.id}"
                        data-asset-id="${row.aset_id}"
                        data-jumlah="${row.jumlah}"
                        data-deskripsi="${row.deskripsi}"
                    >Edit</button>
                    <a href="${downloadUrl}" class="btn btn-sm btn-info" target="_blank">Download Doc</a>
                `;
            }
        });
    }

    $(function() {
        var table = $('#datatable-kerusakan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('kerusakan/get_kerusakan') ?>',
                type: 'POST',
            },
            columns: columns,
        });

        $('#btnTambahKerusakan').click(function() {
            $('#tambahKerusakan form')[0].reset();
            $('#mode').val('tambah');
            $('#id_kerusakan').val('');
        });

        $('#datatable-kerusakan tbody').on('click', '.btn-edit', function() {
            var btn = $(this);
            $('#mode').val('edit');
            $('#id_kerusakan').val(btn.data('id'));
            $('#asset_kerusakan').val(btn.data('asset-id'));
            $('#jumlah_kerusakan').val(btn.data('jumlah'));
            $('#deskripsi_kerusakan').val(btn.data('deskripsi'));
            $('#tambahKerusakan').modal('show');
        });
    });
</script>