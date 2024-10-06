<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil</h1>
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
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <p>Atur profil anda disini</p>
            <hr>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Horizontal Form -->
            <div class="card card-info">
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
                <?php if (session()->getFlashdata('updateSuccess')) : ?>
                    <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                        <?= session()->getFlashdata('updateSuccess') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <!-- form start -->
                <form class="form-horizontal" action="/editBiodataGuru" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= session('id') ?>">
                    <div class="card-body">
                        <h5>A. BIODATA</h5>
                        <hr>
                        <div class="px-4 mb-5">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $data['user']->name ?>" required autocomplete="off" placeholder="Nama Lengkap">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $data['user']->email ?>" required autocomplete="off" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nik" id="nik" value="<?= $data['user']->nik ?>" required autocomplete="off" placeholder="NIK">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="education" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="education" id="education" required>
                                        <option <?php if ($data['user']->education == "SD / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SD / Sederajat">SD / Sederajat</option>
                                        <option <?php if ($data['user']->education == "SMP / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMP / Sederajat">SMP / Sederajat</option>
                                        <option <?php if ($data['user']->education == "SMA / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMA / Sederajat">SMA / Sederajat</option>
                                        <option <?php if ($data['user']->education == "Diploma / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Diploma / Sederajat">Diploma / Sederajat</option>
                                        <option <?php if ($data['user']->education == "Sarjana / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Sarjana / Sederajat">Sarjana / Sederajat</option>
                                        <option <?php if ($data['user']->education == "Magister / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Magister / Sederajat">Magister / Sederajat</option>
                                        <option <?php if ($data['user']->education == "Doktor / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Doktor / Sederajat">Doktor / Sederajat</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="avatar" id="avatar" autocomplete="off" placeholder="Foto">
                                </div>
                            </div>
                        </div>

                        <h5>B. DATA KEPEGAWAIAN</h5>
                        <hr>
                        <div class="px-4 mb-5">
                            <div class="form-group row">
                                <label for="nuptk" class="col-sm-2 col-form-label">NUPTK</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nuptk" id="nuptk" value="<?= $data['user']->nuptk ?>" required autocomplete="off" placeholder="NUPTK">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nrg" class="col-sm-2 col-form-label">NRG</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nrg" id="nrg" value="<?= $data['user']->nrg ?>" required autocomplete="off" placeholder="NRG">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employee_status" class="col-sm-2 col-form-label">Status Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="employee_status" id="employee_status" value="<?= $data['user']->employee_status ?>" required autocomplete="off" placeholder="Status Pegawai">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="position" class="col-sm-2 col-form-label">Jabatan / Tugas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="position" id="position" required>
                                        <?php if (session('role') == 1) { ?>
                                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                                            <option value="Staff">Staff</option>
                                        <?php } else { ?>
                                            <option value="Guru">Guru</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5>C. DATA INSTANSI INDUK</h5>
                        <hr>
                        <div class="px-4 mb-5">
                            <div class="form-group row">
                                <label for="institution" class="col-sm-2 col-form-label">Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="institution" id="institution" value="<?= $data['user']->institution ?>" required autocomplete="off" placeholder="Instansi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="npsn" class="col-sm-2 col-form-label">NPSN</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="npsn" id="npsn" value="<?= $data['user']->npsn ?>" required autocomplete="off" placeholder="NPSN">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="school_address" class="col-sm-2 col-form-label">Alamat Sekolah</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="school_address" id="school_address" required placeholder="Alamat Sekolah"><?= $data['user']->school_address ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="reset" class="btn btn-danger m-1">Reset</button>
                            <button type="submit" class="btn btn-primary m-1">Simpan</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>