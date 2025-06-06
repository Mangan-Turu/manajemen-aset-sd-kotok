<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Pengguna</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary">Tambah Pengguna</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-pengguna" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<script>
    $(function() {
        $('#datatable-pengguna').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pengguna/get_pengguna') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>'; // sesuaikan nama tokennya
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role'
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var editUrl = '<?= base_url('pengguna/edit/') ?>' + data;
                        var deleteUrl = '<?= base_url('pengguna/delete/') ?>' + data;
                        return `
                            <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="${deleteUrl}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            `;
                    }
                }
            ]
        });
    });
</script>
<!-- End Data Table -->