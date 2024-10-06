<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa Pendaftar Ekstrakurikuler</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">
                                <?php

                                use App\Models\AnggotaKelas;
                                use App\Models\Kelas;

                                if (session('role') == 1) {
                                    echo 'Administrator';
                                } else {
                                    echo 'Guru';
                                }
                                ?>
                            </a></li>
                        <li class="breadcrumb-item active">Data Siswa Pendaftar Ekstrakurikuler</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <p>di KB-TK Islam At-Taqwa</p>
            <hr>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('deleteEkstrakurikulerSayaSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteEkstrakurikulerSayaSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <table id="pendaftar-ekstrakurikuler" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Asal Kelas</th>
                                        <th>Kegiatan Ekstrakurikuler</th>
                                        <?php if (session('role') == 1) { ?>
                                            <th>Keluar</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $anggotaKelasModel = new AnggotaKelas();
                                    $kelasModel = new Kelas();
                                    foreach ($data['pendaftar'] as $key => $siswa) :
                                        $anggotaKelas = $anggotaKelasModel->where('user_id', $siswa['student_id'])->first();
                                        $kelas = $kelasModel->where('id', $anggotaKelas['class_id'])->first();
                                    ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $siswa['nisn'] ?></td>
                                            <td><?= $siswa['name'] ?></td>
                                            <td><?= $kelas['name'] ?></td>
                                            <td><?= $siswa['ekstrakurikuler_name'] ?></td>
                                            <?php if (session('role') == 1) { ?>
                                                <td>
                                                    <a href="/siswa/keluarEkstrakurikuler/<?= $siswa['ekstrakurikuler_id'] ?>/<?= $siswa['student_id'] ?>" class="btn btn-danger" method="post">
                                                        <?= csrf_field() ?>
                                                        <i class="fa-solid fa-right-from-bracket"></i>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>