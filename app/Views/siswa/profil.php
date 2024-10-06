<?= $this->extend('siswa/layouts/main'); ?>

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
                        <li class="breadcrumb-item"><a href="/siswa/profil">
                                Siswa
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
                <form class="form-horizontal" action="/editBiodataSiswa" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['user']->student_id ?>">
                    <div class="card-body">
                        <h5>A. IDENTITAS ANAK</h5>
                        <hr>
                        <div class="px-4 mb-5">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $data['user']->name ?>" required autocomplete="off" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="call" class="col-sm-2 col-form-label">Nama Panggilan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="call" id="call" value="<?= $data['user']->call ?>" required autocomplete="off" placeholder="Nama Panggilan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option <?php if ($data['user']->gender == "Laki - laki") {
                                                    echo 'selected';
                                                } ?> value="Laki - laki">Laki - laki</option>
                                        <option <?php if ($data['user']->gender == "Perempuan") {
                                                    echo 'selected';
                                                } ?> value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthday" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?= $data['user']->birthday ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="address" id="address" required><?= $data['user']->address ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nth_child" class="col-sm-2 col-form-label">Anak ke-</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nth_child" id="nth_child" value="<?= $data['user']->nth_child ?>" required autocomplete="off" placeholder="Anak ke-">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="siblings" class="col-sm-2 col-form-label">Jumlah Saudara Kandung</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="siblings" id="siblings" value="<?= $data['user']->siblings ?>" required autocomplete="off" placeholder="Jumlah Saudara Kandung">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="religion" id="religion" required>
                                        <option <?php if ($data['user']->religion == "Islam") echo 'selected'; ?> value="Islam">Islam</option>
                                        <option <?php if ($data['user']->religion == "Kristen") echo 'selected'; ?> value="Kristen">Kristen</option>
                                        <option <?php if ($data['user']->religion == "Katolik") echo 'selected'; ?> value="Katolik">Katolik</option>
                                        <option <?php if ($data['user']->religion == "Hindu") echo 'selected'; ?> value="Hindu">Hindu</option>
                                        <option <?php if ($data['user']->religion == "Buddha") echo 'selected'; ?> value="Buddha">Buddha</option>
                                        <option <?php if ($data['user']->religion == "Konghucu") echo 'selected'; ?> value="Konghucu">Konghucu</option>
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

                        <h5>B. IDENTITAS ORANG TUA</h5>
                        <hr>
                        <div class="px-4 mb-5">
                            <div class="form-group row">
                                <label for="fathers_name" class="col-sm-2 col-form-label">Nama Ayah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fathers_name" id="fathers_name" value="<?= $data['user']->fathers_name ?>" required autocomplete="off" placeholder="Nama Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_name" class="col-sm-2 col-form-label">Nama Ibu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mothers_name" id="mothers_name" value="<?= $data['user']->mothers_name ?>" required autocomplete="off" placeholder="Nama Ibu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_phone" class="col-sm-2 col-form-label">Telepon Ayah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="fathers_phone" id="fathers_phone" value="<?= $data['user']->fathers_phone ?>" required autocomplete="off" placeholder="Nama Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_phone" class="col-sm-2 col-form-label">Telepon Ibu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="mothers_phone" id="mothers_phone" value="<?= $data['user']->mothers_phone ?>" required autocomplete="off" placeholder="Nama Ibu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_birthday" class="col-sm-2 col-form-label">Tanggal Lahir Ayah</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="fathers_birthday" id="fathers_birthday" value="<?= $data['user']->fathers_birthday ?>" required autocomplete="off" placeholder="Tanggal Lahir Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_birthday" class="col-sm-2 col-form-label">Tanggal Lahir Ibu</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="mothers_birthday" id="mothers_birthday" value="<?= $data['user']->mothers_birthday ?>" required autocomplete="off" placeholder="Tanggal Lahir Ibu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_nik" class="col-sm-2 col-form-label">NIK Ayah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="fathers_nik" id="fathers_nik" value="<?= $data['user']->fathers_nik ?>" required autocomplete="off" placeholder="NIK Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_nik" class="col-sm-2 col-form-label">NIK Ibu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="mothers_nik" id="mothers_nik" value="<?= $data['user']->mothers_nik ?>" required autocomplete="off" placeholder="NIK Ibu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_edu" class="col-sm-2 col-form-label">Pendidikan Tertinggi Ayah</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="fathers_edu" id="fathers_edu" required>
                                        <option <?php if ($data['user']->fathers_edu == "SD / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SD / Sederajat">SD / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "SMP / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMP / Sederajat">SMP / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "SMA / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMA / Sederajat">SMA / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "Diploma / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Diploma / Sederajat">Diploma / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "Sarjana / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Sarjana / Sederajat">Sarjana / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "Magister / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Magister / Sederajat">Magister / Sederajat</option>
                                        <option <?php if ($data['user']->fathers_edu == "Doktor / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Doktor / Sederajat">Doktor / Sederajat</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_edu" class="col-sm-2 col-form-label">Pendidikan Tertinggi Ibu</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="mothers_edu" id="mothers_edu" required>
                                        <option <?php if ($data['user']->mothers_edu == "SD / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SD / Sederajat">SD / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "SMP / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMP / Sederajat">SMP / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "SMA / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="SMA / Sederajat">SMA / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "Diploma / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Diploma / Sederajat">Diploma / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "Sarjana / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Sarjana / Sederajat">Sarjana / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "Magister / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Magister / Sederajat">Magister / Sederajat</option>
                                        <option <?php if ($data['user']->mothers_edu == "Doktor / Sederajat") {
                                                    echo 'selected';
                                                } ?> value="Doktor / Sederajat">Doktor / Sederajat</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_occupation" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fathers_occupation" id="fathers_occupation" value="<?= $data['user']->fathers_occupation ?>" required autocomplete="off" placeholder="Pekerjaan Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_occupation" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mothers_occupation" id="mothers_occupation" value="<?= $data['user']->mothers_occupation ?>" required autocomplete="off" placeholder="Pekerjaan Ibu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathers_income" class="col-sm-2 col-form-label">Penghasilan Ayah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="fathers_income" id="fathers_income" value="<?= $data['user']->fathers_income ?>" required autocomplete="off" placeholder="Penghasilan Ayah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mothers_income" class="col-sm-2 col-form-label">Penghasilan Ibu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="mothers_income" id="mothers_income" value="<?= $data['user']->mothers_income ?>" required autocomplete="off" placeholder="Penghasilan Ibu">
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