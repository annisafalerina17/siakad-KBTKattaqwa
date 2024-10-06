<?= $this->extend('admin/layouts/main'); ?>

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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">
                                <?php
                                if (session('role') == 1) {
                                    echo 'Administrator';
                                } else {
                                    echo 'Guru';
                                }
                                ?>
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
                            <?php if (session()->getFlashdata('tambahJadwalEkstrakurikulerSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('tambahJadwalEkstrakurikulerSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('editJadwalEkstrakurikulerSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('editJadwalEkstrakurikulerSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('deleteJadwalEkstrakurikulerSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteJadwalEkstrakurikulerSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if (session('role') == "1") { ?>
                                <button type="button" class="btn btn-secondary mb-4" data-toggle="modal" data-target="#tambahData">
                                    Tambah Data
                                </button>
                            <?php } else {
                                echo '';
                            } ?>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Ekstrakurikuler</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/admin/tambahJadwalEkstrakurikuler" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Kegiatan</label>
                                                    <input type="text" class="form-control" name="name" id="name" required autocomplete="off" placeholder="Kegiatan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="coach">Nama Pelatih</label>
                                                    <input type="text" class="form-control" name="coach" id="coach" required autocomplete="off" placeholder="Nama Pelatih">
                                                </div>
                                                <div class="form-group">
                                                    <label for="day">Hari</label>
                                                    <select class="form-control" name="day" id="day" required>
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jumat</option>
                                                        <option value="Sabtu">Sabtu</option>
                                                        <option value="Minggu">Minggu</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time_start">Jam Mulai</label>
                                                    <input type="TIME" class="form-control" name="time_start" id="time_start" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time_end">Jam Selesai</label>
                                                    <input type="TIME" class="form-control" name="time_end" id="time_end" required>
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

                            <table id="data-ekstrakurikuler" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Nama Pelatih</th>
                                        <th>Hari</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <?php if (session('role') == 1) { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
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
                                            <?php if (session('role') == 1) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#edit<?= $ekstrakurikuler['id'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    <a href="/admin/deleteJadwalEkstrakurikuler/<?= $ekstrakurikuler['id'] ?>" class="btn btn-danger m-1" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit<?= $ekstrakurikuler['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Ekstrakurikuler </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/admin/editJadwalEkstrakurikuler" method="post">
                                                                    <input type="hidden" name="id" id="id" value="<?= $ekstrakurikuler['id'] ?>">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Kegiatan</label>
                                                                            <input type="text" class="form-control" name="name" id="name" value="<?= $ekstrakurikuler['name'] ?>" required autocomplete="off" placeholder="Kegiatan">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="coach">Nama Pelatih</label>
                                                                            <input type="text" class="form-control" name="coach" id="coach" value="<?= $ekstrakurikuler['coach'] ?>" required autocomplete="off" placeholder="Nama Pelatih">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="day">Hari</label>
                                                                            <select class="form-control" name="day" id="day" required>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Senin") {
                                                                                            echo "selected";
                                                                                        } ?> value="Senin">Senin</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Selasa") {
                                                                                            echo "selected";
                                                                                        } ?> value="Selasa">Selasa</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Rabu") {
                                                                                            echo "selected";
                                                                                        } ?> value="Rabu">Rabu</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Kamis") {
                                                                                            echo "selected";
                                                                                        } ?> value="Kamis">Kamis</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Jumat") {
                                                                                            echo "selected";
                                                                                        } ?> value="Jumat">Jumat</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Sabtu") {
                                                                                            echo "selected";
                                                                                        } ?> value="Sabtu">Sabtu</option>
                                                                                <option <?php if ($ekstrakurikuler['day'] == "Minggu") {
                                                                                            echo "selected";
                                                                                        } ?> value="Minggu">Minggu</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="time_start">Jam Mulai</label>
                                                                            <input type="TIME" class="form-control" name="time_start" id="time_start" value="<?= $ekstrakurikuler['time_start'] ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="time_end">Jam Selesai</label>
                                                                            <input type="TIME" class="form-control" name="time_end" value="<?= $ekstrakurikuler['time_end'] ?>" id="time_end" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-danger">Reset</button>
                                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php } ?>
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