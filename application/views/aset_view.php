<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Data Aset</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahAset" id="btnTambahAset">Tambah Aset</button>
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

<!-- Load Modal -->
<?php $this->load->view('components/modal/modal_tambah_aset'); ?>
<!-- End Load Modal -->

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
                        var deleteUrl = '<?= base_url('aset/delete/') ?>' + data;
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit"
                                data-id="${data}" 
                                data-nama_aset="${row.nama_aset}"
                                data-kategori="${row.kategori}"
                                data-merk="${row.merk}"
                                data-tipe="${row.tipe}"
                                data-spesifikasi="${row.spesifikasi}"
                                data-jumlah="${row.jumlah}"
                                data-satuan="${row.satuan}"
                                data-lokasi_fisik="${row.lokasi_fisik}"
                                data-ruangan_id="${row.ruangan_id}"
                                data-tahun_perolehan="${row.tahun_perolehan}"
                                data-sumber_dana="${row.sumber_dana}"
                                data-harga_satuan="${row.harga_satuan}"
                                data-toggle="modal" 
                                data-target="#tambahAset"
                            >Edit</button>
                            <a href="" class="btn btn-sm btn-danger btn-confirm-delete" data-url="${deleteUrl}">Hapus</a>
                        `;
                    }
                }
            ]
        });
    });

    $(document).on('click', '.btn-edit', function() {
        const fields = ['id', 'nama_aset', 'kategori', 'merk', 'tipe', 'spesifikasi', 'jumlah', 'satuan', 'lokasi_fisik', 'ruangan_id', 'tahun_perolehan', 'sumber_dana', 'harga_satuan'];

        fields.forEach(field => {
            $(`#${field}`).val($(this).attr('data-' + field));
        });

        $('#mode').val('edit');
        $('#modalTambahLabel').text('Edit Siswa');
    });

    $(document).on('click', '#btnTambahSiswa', function() {
        resetForm('#formAset', 'tambah', '', 'Tambah Aset');
    });
</script>
<!-- End Data Table -->