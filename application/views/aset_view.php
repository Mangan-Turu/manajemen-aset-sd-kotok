<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Aset</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary">Tambah Aset</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-aset" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Lokasi</th>
                            <th>Ruangan</th>
                            <th>Tahun</th>
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
        $('#datatable-aset').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('aset/get_aset') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>';
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'kode_aset'
                },
                {
                    data: 'nama_aset'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'merk'
                },
                {
                    data: 'tipe'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'lokasi_fisik'
                },
                {
                    data: 'ruangan_nama'
                }, // pastikan digabung di query (join)
                {
                    data: 'tahun_perolehan'
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var editUrl = '<?= base_url('aset/edit/') ?>' + data;
                        var deleteUrl = '<?= base_url('aset/delete/') ?>' + data;
                        return `
                            <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="${deleteUrl}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data aset ini?')">Hapus</a>
                        `;
                    }
                }
            ]
        });
    });
</script>
<!-- End Data Table -->