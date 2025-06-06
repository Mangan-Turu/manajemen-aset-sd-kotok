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
                <table id="datatable-siswa" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Orang Tua</th>
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
        $('#datatable-siswa').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('siswa/get_siswa') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>'; // ganti jika nama CSRF berbeda
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nis'
                },
                {
                    data: 'nama_siswa'
                },
                {
                    data: 'kelas'
                },
                {
                    data: 'jenis_kelamin'
                },
                {
                    data: 'nama_ortu'
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var editUrl = '<?= base_url('siswa/edit/') ?>' + data;
                        var deleteUrl = '<?= base_url('siswa/delete/') ?>' + data;
                        return `
                            <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="${deleteUrl}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data siswa ini?')">Hapus</a>
                        `;
                    }
                }
            ]
        });
    });
</script>
<!-- End Data Table -->