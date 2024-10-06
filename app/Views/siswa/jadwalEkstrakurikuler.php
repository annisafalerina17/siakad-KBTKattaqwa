<?= $this->extend('siswa/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Ekstrakurikuler</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/siswa/profil">
                                Siswa
                            </a></li>
                        <li class="breadcrumb-item active">Data Ekstrakurikuler</li>
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
                                        <th>Kegiatan</th>
                                        <th>Nama Pelatih</th>
                                        <th>Hari</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['ekstrakurikuler'] as $ekstrakurikuler) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $ekstrakurikuler['name'] ?></td>
                                            <td><?= $ekstrakurikuler['coach'] ?></td>
                                            <td><?= $ekstrakurikuler['day'] ?></td>
                                            <td><?= $ekstrakurikuler['time_start'] ?></td>
                                            <td><?= $ekstrakurikuler['time_end'] ?></td>
                                        </tr>
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