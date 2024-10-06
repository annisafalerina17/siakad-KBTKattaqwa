<?= $this->extend('siswa/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail LPPD <br><b><?= $data['siswa']['nisn'] ?> - <?= $data['siswa']['name'] ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/siswa/profil">
                                Siswa
                            </a></li>
                        <li class="breadcrumb-item"><a href="/siswa/detailLppd">
                                Laporan Perkembangan
                            </a></li>
                        <li class="breadcrumb-item active">Detail LPPD</li>
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
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['lppd'] as $lppd) { ?>
                                        <tr>
                                            <td><?= $lppd['className'] ?></td>
                                            <td>
                                                <?php
                                                if ($lppd['semester'] == 1) {
                                                    echo "LPPD Tengah Semester 1";
                                                } elseif ($lppd['semester'] == 2) {
                                                    echo "LPPD Semester 1";
                                                } elseif ($lppd['semester'] == 3) {
                                                    echo "LPPD Tengah Semester 2";
                                                } elseif ($lppd['semester'] == 4) {
                                                    echo "LPPD Semester 2";
                                                } else {
                                                    echo "Semester " . $lppd['semester'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('lppd/' . $lppd['lppd']) ?>" class="btn btn-primary" download><i class="fa-solid fa-download"></i></a>
                                            </td>
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