<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Siswa</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary">Tambah Siswa</button>
                </div>
            </div>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<script>
    $(function() {
        $('#datatable-pengadaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pengadaan/get_pengadaan') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>'; // sesuaikan nama token jika berbeda
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'no_pengadaan'
                },
                {
                    data: 'tanggal_pengadaan',
                    render: function(data, type, row) {
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
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var editUrl = '<?= base_url('pengadaan/edit/') ?>' + data;
                        var deleteUrl = '<?= base_url('pengadaan/delete/') ?>' + data;
                        return `
                        <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="${deleteUrl}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data pengadaan ini?')">Hapus</a>
                    `;
                    }
                }
            ]
        });
    });
</script>
<!-- End Data Table -->