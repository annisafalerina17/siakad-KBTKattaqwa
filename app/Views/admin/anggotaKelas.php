<!-- pewaris template utama -->
<?= $this->extend('admin/layouts/main'); ?>

<!-- awal bagian konten -->
<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembagian Guru dan Kelas <?= $data['kelas']['name'] ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Administrator</a></li>
                        <li class="breadcrumb-item"><a href="/admin/pembagianGuruKelas">Pembagian Guru dan Kelas</a></li>
                        <li class="breadcrumb-item active"><?= $data['kelas']['name'] ?></li>
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

                            <!-- line 36-51 (pesan notifikasi) -->
                            <?php if (session()->getFlashdata('tambahAnggotaKelasSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('tambahAnggotaKelasSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('deleteAnggotaKelasSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteAnggotaKelasSuccess') ?>
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
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Anggota Kelas <?= $data['kelas']['name'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/admin/tambahAnggotaKelas" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="class_id" value="<?= $data['kelas']['id'] ?>">

                                                <div class="form-group">
                                                    <label for="user_id">Nama Guru / Siswa</label>
                                                    <select class="form-control" name="user_id" id="user_id" required>
                                                        <?php
                                                        foreach ($data['nonClassGuru'] as $nonClassGuru) {
                                                        ?>
                                                            <option value="<?= $nonClassGuru['teacher_id'] ?>"><?= $nonClassGuru['nuptk'] ?> - <?= $nonClassGuru['name'] ?></option>
                                                        <?php } ?>
                                                        <hr>
                                                        <?php
                                                        foreach ($data['nonClassSiswa'] as $nonClassSiswa) {
                                                        ?>
                                                            <option value="<?= $nonClassSiswa['student_id'] ?>"><?= $nonClassSiswa['nisn'] ?> - <?= $nonClassSiswa['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
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

                            <table id="data-anggota-kelas" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tingkatan</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td>
                                                <a href="/admin/deleteAnggotaKelas/<?= $guru['teacher_id'] ?>" class="btn btn-danger m-1" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
                                            </td>
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
                                            <td>
                                                <a href="/admin/deleteAnggotaKelas/<?= $siswa['student_id'] ?>" class="btn btn-danger m-1" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
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