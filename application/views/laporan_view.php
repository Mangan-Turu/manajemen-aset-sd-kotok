<div class="row">
    <div class="col">
        <div class="card">
            <?php if ($this->session->userdata('role') === 'admin'): ?>
                <div class="card-header">
                    <h2 class="card-title">Informasi Data Aset</h2>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahAset" id="btnTambahAset">Download Laporan</button> -->
                        <button type="button" class="btn btn-sm btn-success" id="export_excel">Export Excel</button>
                    </div>
                </div>
            <?php endif ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-laporan" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Lokasi</th>
                                <th>Jenis Ruangan</th>
                                <th>Tahun</th>
                                <th>Nilai Aset</th>
                                <th>Pengadaan Terakhir</th>
                                <th>Mutasi</th>
                                <th>Kerusakan</th>
                                <th>Biaya Pemeliharaan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Data Table -->
<script>
    $(function() {
        const table = $('#datatable-laporan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('laporan/get_laporan') ?>',
                type: 'POST',
                data: function(d) {
                    d.csrf_token_name = '<?= $this->security->get_csrf_hash() ?>';
                }
            },
            columns: columns
        });

        // Pastikan tombol export bekerja hanya saat XLSX tersedia
        document.getElementById('export_excel').addEventListener('click', function() {
            if (typeof XLSX === 'undefined') {
                alert('XLSX library tidak tersedia.');
                return;
            }

            const data = table.rows({
                search: 'applied'
            }).data().toArray();

            if (data.length === 0) {
                alert('Tidak ada data untuk diexport.');
                return;
            }

            const header = columns.map(col => col.data.replace(/_/g, ' '));
            const body = data.map(row => columns.map(col => row[col.data]));

            const worksheet = XLSX.utils.aoa_to_sheet([header, ...body]);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Laporan Aset');

            try {
                XLSX.writeFile(workbook, 'Laporan_Aset.xlsx');
            } catch (e) {
                alert('Gagal menyimpan file: ' + e.message);
                console.error(e);
            }
        });
    });

    const columns = [{
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
            data: 'satuan'
        },
        {
            data: 'nama_ruangan'
        },
        {
            data: 'jenis_ruangan'
        },
        {
            data: 'tahun_perolehan'
        },
        {
            data: 'total_nilai_aset',
            render: function(data, type, row) {
                return data ?? 0;
            }
        },
        {
            data: 'terakhir_pengadaan',
            render: function(data, type, row) {
                return data ? new Intl.DateTimeFormat('id-ID').format(new Date(data)) : '-';
            }
        },
        {
            data: 'total_mutasi',
            render: function(data, type, row) {
                return data ? new Intl.NumberFormat('id-ID').format(data) : '-';
            }
        },
        {
            data: 'total_kerusakan',
            render: function(data, type, row) {
                return data ? new Intl.NumberFormat('id-ID').format(data) : '-';
            }
        },
        {
            data: 'total_biaya_pemeliharaan',
            render: function(data, type, row) {
                return data ?? '-';
            }
        },
    ];
</script>
<!-- End Data Table -->