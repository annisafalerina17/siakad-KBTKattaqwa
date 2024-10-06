<?= $this->extend('admin/layouts/main'); ?>

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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">
                                <?php
                                if (session('role') == 1) {
                                    echo 'Administrator';
                                } else {
                                    echo 'Guru';
                                }
                                ?>
                            </a></li>
                        <li class="breadcrumb-item"><a href="/admin/laporanPerkembangan">
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

                            <?php if (session()->has('errors')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <ul>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('tambahLppdSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('tambahLppdSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('deleteLppdSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteLppdSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary mb-4" data-toggle="modal" data-target="#tambahData">
                                Tambah Data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data LPPD</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/admin/tambahLppd" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="student_id" value="<?= $data['siswa']['student_id'] ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="className">Kelas</label>
                                                    <input type="text" readonly class="form-control" name="className" id="className" value="<?= $data['className'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="semester">Semester</label>
                                                    <select class="form-control" name="semester" id="semester" required>
                                                        <?php foreach ($data['semesterUnset'] as $smt) { ?>
                                                            <option value="<?= $smt ?>">
                                                                <?php
                                                                if ($smt == 1) {
                                                                    echo "Tengah Semester 1";
                                                                } elseif ($smt == 2) {
                                                                    echo "Semester 1";
                                                                } elseif ($smt == 3) {
                                                                    echo "Tengah Semester 2";
                                                                } elseif ($smt == 4) {
                                                                    echo "Semester 2";
                                                                } else {
                                                                    echo "Semester " . $smt;
                                                                }
                                                                ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lppd">LPPD <small>dalam bentuk PDF</small></label>
                                                    <input type="file" class="form-control" name="lppd" id="lppd" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table id="data-detail-lppd" class="table table-bordered table-striped">
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
                                                <a href="/admin/deleteLppd/<?= $lppd['id'] ?>" class="btn btn-danger" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
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