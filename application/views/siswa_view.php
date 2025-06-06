<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Siswa</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSiswa" id="btnTambahSiswa">Tambah Siswa</button>
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

<!-- Load Modal -->
<?php $this->load->view('components/modal/modal_tambah_siswa'); ?>
<!-- End Load Modal -->

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
                    data: 'jenis_kelamin',
                    render: function(data, type, row) {
                        return data === 'L' ? 'Laki-laki' : 'Perempuan';
                    }
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
                        var deleteUrl = '<?= base_url('siswa/delete/') ?>' + data;
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit"
                                data-id_siswa="${data}"
                                data-nis="${row.nis}"
                                data-nama_siswa="${row.nama_siswa}"
                                data-kelas="${row.kelas}"
                                data-tempat_lahir="${row.tempat_lahir}"
                                data-tanggal_lahir="${row.tanggal_lahir}"
                                data-jenis_kelamin="${row.jenis_kelamin}"
                                data-alamat="${row.alamat}"
                                data-nama_ortu="${row.nama_ortu}"
                                data-no_hp_ortu="${row.no_hp_ortu}"
                                data-status_aktif="${row.status_aktif}"
                                data-toggle="modal"
                                data-target="#tambahSiswa"
                            >
                                Edit
                            </button>
                            <a href="" class="btn btn-sm btn-danger btn-confirm-delete" data-url="${deleteUrl}">Hapus</a>
                        `;
                    }
                }
            ]
        });
    });

    $(document).on('click', '.btn-edit', function() {
        const fields = ['id_siswa', 'nis', 'nama_siswa', 'kelas', 'tempat_lahir', 'tanggal_lahir','jenis_kelamin', 'alamat', 'nama_ortu', 'no_hp_ortu', 'status_aktif'];

        fields.forEach(field => {
            $(`#${field}`).val($(this).attr('data-' + field));
        });

        $('#mode').val('edit');
        $('#modalTambahLabel').text('Edit Siswa');
    });

    $(document).on('click', '#btnTambahSiswa', function() {
        resetForm('#formSiswa', 'tambah', '', 'Tambah Siswa');
    });
</script>
<!-- End Data Table -->