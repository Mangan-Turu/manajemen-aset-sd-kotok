<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : 'Tidak ada judul'; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/summernote/summernote-bs4.min.css">
    <script src="<?= base_url(); ?>/assets/templates/AdminLTE-3.2.0/dist/js/sweetalert.js"></script>

    <!-- swal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Jquery -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- Custom CSS and JS -->
    <style>
        #datatable-laporan td,
        #datatable-laporan th {
            white-space: nowrap;
        }

        #datatable-laporan tr th,
        #datatable-laporan tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>

    <script>
        const isAdmin = <?= $this->session->userdata('role') === 'admin' ? 'true' : 'false' ?>;
    </script>
    <script>
        const OPTION_URL = {
            get_aset: '<?= site_url('option/get_aset') ?>',
            get_ruangan: '<?= site_url('option/get_ruangan') ?>'
        };

        // Reset Form
        function resetForm(form, mode, id, label) {
            $(form)[0].reset();
            $(mode).val('tambah');
            $(id).val('');
            $(label).text('Tambah Pengguna');
        }
        // End Reset Form


        // Select Ruangan
        function fetchRuangan(selectId) {
            $.ajax({
                url: OPTION_URL.get_ruangan,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $select = $(`#${selectId}`);
                    $select.empty().append('<option value="">Pilih Ruangan</option>');
                    data.forEach(item => {
                        $select.append(`<option value="${item.id}">${item.nama_ruangan}</option>`);
                    });
                },
                error: function() {
                    alert('Gagal mengambil data ruangan.');
                }
            });
        }
        // End Select Ruangan

        // Select Aset
        function fetchAset(selectId) {
            $.ajax({
                url: OPTION_URL.get_aset,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $select = $(`#${selectId}`);
                    $select.empty().append('<option value="">Pilih Asset</option>');
                    data.forEach(item => {
                        $select.append(`<option value="${item.id}">${item.nama_aset}</option>`);
                    });
                },
                error: function() {
                    alert('Gagal mengambil data aset.');
                }
            });
        }
        // End Select Aset
    </script>
    <!-- End Custom CSS and JS -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <h3 class="m-0 px-2"><?= isset($title) ? $title : ''; ?></h3>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SD KOTOK</span>
            </a>

            <!-- Sidebar -->
            <?php
            $current = $this->uri->segment(1);
            $navigation = $this->config->item('navigation');
            $userRole = $this->session->userdata('role'); // Ambil role dari session
            ?>

            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php foreach ($navigation as $item): ?>
                            <?php
                            // Tampilkan hanya jika role pengguna termasuk dalam array 'role' item menu
                            if (!in_array($userRole, $item['role'])) {
                                continue;
                            }

                            $isActive = in_array($current, $item['active']);
                            $hasChildren = isset($item['children']);
                            ?>
                            <li class="nav-item <?= $hasChildren && $isActive ? 'menu-open' : '' ?>">
                                <a href="<?= $hasChildren ? '#' : base_url($item['url']) ?>" class="nav-link <?= $isActive ? 'active' : '' ?>">
                                    <i class="nav-icon <?= $item['icon'] ?>"></i>
                                    <p>
                                        <?= $item['label'] ?>
                                        <?= $hasChildren ? '<i class="right fas fa-angle-left"></i>' : '' ?>
                                    </p>
                                </a>

                                <?php if ($hasChildren): ?>
                                    <ul class="nav nav-treeview">
                                        <?php foreach ($item['children'] as $child): ?>
                                            <?php
                                            // Jika child juga memiliki pengaturan role, kamu bisa menambahkan ini:
                                            if (isset($child['role']) && !in_array($userRole, $child['role'])) {
                                                continue;
                                            }
                                            ?>
                                            <li class="nav-item">
                                                <a href="<?= base_url($child['url']) ?>" class="nav-link <?= in_array($current, $child['active']) ? 'active' : '' ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p><?= $child['label'] ?></p>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>

            <!-- /.sidebar -->
        </aside>
        <!-- End Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->

                    <!-- Show Alert -->
                    <div class="row">
                        <div class="col">
                            <?php if ($this->session->flashdata('alert_danger')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('alert_danger') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('alert_success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('alert_success') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End Show Alert -->

                    <?= $contents; ?>

                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/dist/js/adminlte.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/templates/AdminLTE-3.2.0'); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Swal alert
        $(document).on('click', '.btn-confirm-delete', function(e) {
            e.preventDefault();

            console.log('Button clicked');
            const deleteUrl = $(this).data('url');
            const message = $(this).data('message') || 'Yakin ingin menghapus data ini?';


            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof callback === 'function') {
                        callback();
                    } else if (deleteUrl) {
                        window.location.href = deleteUrl;
                    }
                }
            });
        });
        // End Swal alert
    </script>
</body>

</html>