<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">
                                <?php
                                if (session('role') == 1) {
                                    echo 'Administrator';
                                } else {
                                    echo 'Guru';
                                }
                                ?>
                            </a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <p>Hai <?= session('name') ?>, selamat datang di Sistem Informasi Akademik KB-TK Islam At-Taqwa</p>
            <hr>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('resetPasswordFailed')) : ?>
                <div class="alert alert-danger alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                    <?= session()->getFlashdata('resetPasswordFailed') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('resetPasswordSuccess')) : ?>
                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                    <?= session()->getFlashdata('resetPasswordSuccess') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- DATA GURU -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?= $data['jumlahDataGuru'] ?>
                            </h3>

                            <p>Data Guru</p>
                        </div>
                        <?php if (session('role') == 1) { ?>
                            <a href="/admin/dataGuru" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

                <!-- PESERTA DIDIK -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?= $data['jumlahDataSiswa'] ?>
                            </h3>

                            <p>Peserta Didik</p>
                        </div>
                        <?php if (session('role') == 1) { ?>
                            <a href="/admin/dataSiswa" class="small-box-footer">
                                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <!-- RUANG KELAS -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?= $data['jumlahDataKelas'] ?>
                            </h3>

                            <p>Ruang Kelas</p>
                        </div>
                        <?php if (session('role') == 1) { ?>
                            <a href="/admin/pembagianGuruKelas" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

                <!-- KEGIATAN EKSTRAKURIKULER -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>
                                <?= $data['jumlahDataEkstrakurikuler'] ?>
                            </h3>

                            <p>Kegiatan Ekstrakurikuler</p>
                        </div>
                        <?php if (session('role') == 1) { ?>
                            <a href="/admin/jadwalEkstrakurikuler" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>