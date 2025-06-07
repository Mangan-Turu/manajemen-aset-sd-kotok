<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Ruangan</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahRuangan" id="btnTambahRuangan">Tambah Ruangan</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-ruangan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Ruangan</th>
                            <th>Nama Ruangan</th>
                            <th>Jenis</th>
                            <th>Lantai</th>
                            <th>Kapasitas</th>
                            <th>Penanggung Jawab</th>
                            <th>Deskripsi</th>
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
<?php $this->load->view('components/modal/modal_tambah_ruangan'); ?>
<!-- End Load Modal -->

<!-- Data Table -->
<script>
    $(function() {
        $('#datatable-ruangan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('ruangan/get_ruangan') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>'; // ganti jika nama CSRF berbeda
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'kode_ruangan'
                },
                {
                    data: 'nama_ruangan'
                },
                {
                    data: 'jenis_ruangan'
                },
                {
                    data: 'lantai'
                },
                {
                    data: 'kapasitas'
                },
                {
                    data: 'penanggung_jawab'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        var deleteUrl = '<?= base_url('ruangan/delete/') ?>' + data;
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit"
                                data-id="${data}"
                                data-kode_ruangan="${row.kode_ruangan}"
                                data-nama_ruangan="${row.nama_ruangan}"
                                data-jenis_ruangan="${row.jenis_ruangan}"
                                data-lantai="${row.lantai}"
                                data-kapasitas="${row.kapasitas}"
                                data-penanggung_jawab="${row.penanggung_jawab}"
                                data-keterangan="${row.keterangan}"if="${row.status_aktif}"
                                data-toggle="modal"
                                data-target="#tambahRuangan"
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
        const fields = ['id', 'kode_ruangan', 'nama_ruangan', 'jenis_ruangan', 'lantai', 'kapasitas','penanggung_jawab', 'keterangan'];

        fields.forEach(field => {
            $(`#${field}`).val($(this).attr('data-' + field));
        });

        $('#mode').val('edit');
        $('#modalTambahLabel').text('Edit Ruangan');
    });

    $(document).on('click', '#btnTambahRuangan', function() {
        resetForm('#formRuangan', 'tambah', '', 'Tambah Ruangan');
    });
</script>
<!-- End Data Table -->