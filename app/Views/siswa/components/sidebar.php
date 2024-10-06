<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?= base_url(''); ?>/dist/img/siakadLogo.png" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-light">
            Siswa
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(''); ?>/avatar/<?= session('avatar') ?>" class="img-circle" alt="<?= session('name') ?>">
            </div>
            <div class="info">
                <a href="" class="d-block" style="font-size: 13px;"><?= session('name') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>

                <!-- PROFIL -->
                <li class="nav-item">
                    <a href="/siswa/profil" <?php if ($data['title'] == 'Profil') {
                                                echo 'class="nav-link active"';
                                            } else {
                                                echo 'class="nav-link"';
                                            } ?>>
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p style="font-size: 13px;">
                            Profil
                        </p>
                    </a>
                </li>

                <!-- PEMBAGIAN GURU DAN KELAS -->
                <li class="nav-item">
                    <a href="/siswa/pembagianGuruKelasSiswa" <?php if ($data['title'] == 'Pembagian Guru dan Kelas') {
                                                                    echo 'class="nav-link active"';
                                                                } else {
                                                                    echo 'class="nav-link"';
                                                                } ?>>
                        <i class="nav-icon fa-solid fa-users-rectangle"></i>
                        <p style="font-size: 13px;">
                            Pembagian Guru dan Kelas
                        </p>
                    </a>
                </li>

                <!-- LAPORAN PERKEMBANGAN -->
                <li class="nav-item">
                    <a href="#" <?php if ($data['title'] == 'Laporan Perkembangan') {
                                    echo 'class="nav-link active"';
                                } else {
                                    echo 'class="nav-link"';
                                } ?>>
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p style="font-size: 13px;">
                            Laporan Perkembangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/siswa/detailLppd/<?= session('id') ?>" class="nav-link" style="font-size: 13px;">
                                <p>Laporan Perkembangan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- EKSTRAKURIKULER -->
                <li class="nav-item">
                    <a href="#" <?php if ($data['title'] == 'Jadwal Ekstrakurikuler') {
                                    echo 'class="nav-link active"';
                                } else {
                                    echo 'class="nav-link"';
                                } ?>>
                        <i class="nav-icon fa-solid fa-palette"></i>
                        <p style="font-size: 13px;">
                            Ekstrakurikuler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/siswa/jadwalEkstrakurikuler" class="nav-link" style="font-size: 13px;">
                                <p>Jadwal Ekstrakurikuler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/siswa/daftarEkstrakurikuler" class="nav-link" style="font-size: 13px;">
                                <p>Pendaftaran Ekstrakurikuler</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SIGN OUT -->
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p style="font-size: 13px;">
                            Sign Out
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>