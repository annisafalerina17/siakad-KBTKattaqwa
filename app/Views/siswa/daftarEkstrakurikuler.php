<?= $this->extend('siswa/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Ekstrakurikuler</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/siswa/profil">
                                Siswa
                            </a></li>
                        <li class="breadcrumb-item active">Daftar Ekstrakurikuler</li>
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
                            <?php if (session()->getFlashdata('daftarEkstrakurikulerSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('daftarEkstrakurikulerSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('deleteEkstrakurikulerSayaSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteEkstrakurikulerSayaSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary mb-4" data-toggle="modal" data-target="#tambahData">
                                Daftar Ekstrakurikuler
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Formulir Pendaftaran Ekstrakurikuler</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/siswa/masukEkstrakurikuler" method="post">
                                            <input type="hidden" name="id" value="<?= session('id') ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                                                    <select class="form-control" name="ekstrakurikuler_id" id="ekstrakurikuler_id" required>
                                                        <?php foreach ($data['bukanEkstrakurikulerSaya'] as $ekstrakurikuler) { ?>
                                                            <option value="<?= $ekstrakurikuler['id'] ?>"><?= $ekstrakurikuler['name'] ?></option>
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

                            <table id="data-tabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Nama Pelatih</th>
                                        <th>Hari</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['dataEkstrakurikulerSaya'] as $eks) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $eks['name'] ?></td>
                                            <td><?= $eks['coach'] ?></td>
                                            <td><?= $eks['day'] ?></td>
                                            <td><?= $eks['time_start'] ?></td>
                                            <td><?= $eks['time_end'] ?></td>
                                            <td>
                                                <a href="/siswa/keluarEkstrakurikuler/<?= $eks['id'] ?>/<?= session('id') ?>" onclick="return confirm('Konfirmasi hapus data!')" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
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