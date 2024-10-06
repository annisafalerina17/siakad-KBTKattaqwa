<?= $this->extend('siswa/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if ($data['kelas'] != null) { ?>
                        <h1 class="m-0">Pembagian Guru dan Kelas <?= $data['kelas']['name'] ?></h1>
                    <?php } else { ?>
                        <h1 class="m-0">Data kelas belum tersedia</h1>
                    <?php } ?>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/siswa/profil">
                                Siswa
                            </a></li>
                        <li class="breadcrumb-item active">Pembagian Guru dan Kelas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
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

                            <table id="data-tabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tingkatan</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($data['kelas'] != null) { ?>
                                        <?php
                                        $no = 1;
                                        foreach ($data['guru'] as $guru) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $guru['nuptk'] ?></td>
                                                <td><?= $guru['name'] ?></td>
                                                <td><?= $data['kelas']['name'] ?></td>
                                                <td><?= $guru['position'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        foreach ($data['siswa'] as $siswa) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $siswa['nisn'] ?></td>
                                                <td><?= $siswa['name'] ?></td>
                                                <td><?= $data['kelas']['name'] ?></td>
                                                <td>Siswa</td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
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