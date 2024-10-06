<?php
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD | <?= $data['title'] ?></title>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon.png'); ?>">
    <link rel="manifest" href="<?= base_url('favicon.png'); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4fe4318f9d.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= base_url(''); ?>/dist/img/siakadLogo.png" alt="siakadLogo" height="60" width="60">
    </div>

    <div class="wrapper">
        <?= $this->include('admin/components/navbar.php') ?>
        <?= $this->include('admin/components/sidebar.php') ?>
        <?= $this->renderSection('content') ?>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url(''); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url(''); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url(''); ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url(''); ?>/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url(''); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url(''); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url(''); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url(''); ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(''); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(''); ?>/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url(''); ?>/dist/js/pages/dashboard.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url(''); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(''); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#data-guru")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    buttons: ["excel"],
                })
                .buttons()
                .container()
                .appendTo("#data-guru_wrapper .col-md-6:eq(0)");
        });
    </script>
    <?php if (session('role') == 1) { ?>
        <script>
            $(function() {
                $("#data-anggota-kelas")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                        buttons: ["excel"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#data-anggota-kelas_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } else { ?>
        <script>
            $(function() {
                $("#data-anggota-kelas")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                    })
                    .buttons()
                    .container()
                    .appendTo("#data-anggota-kelas_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } ?>

    <?php if (session('role') == 1) { ?>
        <script>
            $(function() {
                $("#data-ekstrakurikuler")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                        buttons: ["excel"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#data-ekstrakurikuler_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } else { ?>
        <script>
            $(function() {
                $("#data-ekstrakurikuler")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                    })
                    .buttons()
                    .container()
                    .appendTo("#data-ekstrakurikuler_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } ?>

    <script>
        $(function() {
            $("#data-siswa")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    buttons: ["excel"],
                })
                .buttons()
                .container()
                .appendTo("#data-siswa_wrapper .col-md-6:eq(0)");
        });
    </script>

    <script>
        $(function() {
            $("#data-laporan-perkembangan")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                })
                .buttons()
                .container()
                .appendTo("#data-laporan-perkembangan_wrapper .col-md-6:eq(0)");
        });
    </script>

    <script>
        $(function() {
            $("#data-detail-lppd")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                })
                .buttons()
                .container()
                .appendTo("#data-detail-lppd_wrapper .col-md-6:eq(0)");
        });
    </script>


    <!-- SHOW PASSWORD -->
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            var confirm_passwordInput = document.getElementById('confirm_password');
            if (this.checked) {
                passwordInput.type = 'text';
                confirm_passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirm_passwordInput.type = 'password';
            }
        });
    </script>

    <?php if (session('role') == 1) { ?>
        <script>
            $(function() {
                $("#pendaftar-ekstrakurikuler")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                        buttons: ["excel"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#pendaftar-ekstrakurikuler_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } else { ?>
        <script>
            $(function() {
                $("#pendaftar-ekstrakurikuler")
                    .DataTable({
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                    })
                    .buttons()
                    .container()
                    .appendTo("#pendaftar-ekstrakurikuler_wrapper .col-md-6:eq(0)");
            });
        </script>
    <?php } ?>
    <script>
        // Menunggu 3 detik (3000 milidetik) lalu menghilangkan alert
        setTimeout(function() {
            var alertElement = document.getElementById('auto-dismiss-alert');
            if (alertElement) {
                // Menghilangkan alert dengan Bootstrap's JavaScript API
                $(alertElement).alert('close');
            }
        }, 3000);
    </script>
</body>

</html>