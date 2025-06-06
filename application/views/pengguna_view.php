<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Pengguna</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahPengguna" id="btnTambahPengguna">Tambah Pengguna</button>
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

<!-- Load Modal -->
<?php $this->load->view('components/modal/modal_tambah_pengguna'); ?>
<!-- End Load Modal -->

<!-- Data Table -->
<script>
    $(function() {
        $('#datatable-pengguna').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pengguna/get_pengguna') ?>',
                type: 'POST',
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
                    data: 'role',
                    render: function(data, type, row) {
                        if (!data) return '-';

                        return data
                            .replace(/_/g, ' ')
                            .split(' ')
                            .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()) // kapitalisasi tiap kata
                            .join(' ');
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var deleteUrl = '<?= base_url('pengguna/delete/') ?>' + data;
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit"
                                data-id="${data}" 
                                data-nama="${row.nama}" 
                                data-username="${row.username}" 
                                data-email="${row.email}" 
                                data-role="${row.role}" 
                                data-no_hp="${row.no_hp || ''}"
                                data-toggle="modal" 
                                data-target="#tambahPengguna"
                            >Edit</button>
                            <a href="" class="btn btn-sm btn-danger btn-confirm-delete" data-url="${deleteUrl}">Hapus</a>
                        `;
                    }
                }
            ]
        });
    });

    $(document).on('click', '.btn-edit', function() {
        const fields = ['id', 'nama', 'username', 'email', 'role', 'no_hp'];
        fields.forEach(field => {
            $(`#${field}`).val($(this).data(field));
        });

        $('#mode').val('edit');
        $('#modalTambahLabel').text('Edit Pengguna');
    });

    $(document).on('click', '#btnTambahPengguna', function() {
        resetForm();
    });

    function resetForm() {
        $('#formPengguna')[0].reset();
        $('#mode').val('tambah');
        $('#id_pengguna').val('');
        $('#modalTambahLabel').text('Tambah Pengguna');
    }
</script>
<!-- End Data Table -->