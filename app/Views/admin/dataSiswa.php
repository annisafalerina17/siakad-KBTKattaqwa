<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
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
                        <li class="breadcrumb-item active">Data Siswa</li>
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
                            <?php if (session()->getFlashdata('registerSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('registerSuccess') ?>
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
                            <?php if (session()->getFlashdata('resetPasswordSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('resetPasswordSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>
                            <?php if (session()->getFlashdata('deleteUserSuccess')) : ?>
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                                    <?= session()->getFlashdata('deleteUserSuccess') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if (session('role') == 1) { ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary mb-4" data-toggle="modal" data-target="#tambahData">
                                    Tambah Data
                                </button>
                            <?php } ?>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Siswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/register" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" required autocomplete="off" placeholder="Username">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password_!!" required autocomplete="off" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password_!!" required autocomplete="off" placeholder="Konfirmasi Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" name="name" id="name" required autocomplete="off" placeholder="Nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="call">Nama Panggilan</label>
                                                    <input type="text" class="form-control" name="call" id="call" required autocomplete="off" placeholder="Nama Panggilan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Jenis Kelamin</label>
                                                    <select class="form-control" name="gender" id="gender" required>
                                                        <option value="Laki - laki">Laki - laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="birthday">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" name="birthday" id="birthday" required autocomplete="off" placeholder="Tanggal Lahir">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <textarea name="address" id="address" required placeholder="Alamat Tempat Tinggal" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fathers_name">Nama Ayah</label>
                                                    <input type="text" class="form-control" name="fathers_name" id="fathers_name" required autocomplete="off" placeholder="Nama Ayah">
                                                </div>
                                                <div class="form-group">
                                                    <label for="mothers_name">Nama Ibu</label>
                                                    <input type="text" class="form-control" name="mothers_name" id="mothers_name" required autocomplete="off" placeholder="Nama Ibu">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fathers_phone">Telepon Ayah</label>
                                                    <input type="number" class="form-control" name="fathers_phone" id="fathers_phone" required autocomplete="off" placeholder="Telepon Ayah">
                                                </div>
                                                <div class="form-group">
                                                    <label for="mothers_phone">Telepon Ibu</label>
                                                    <input type="number" class="form-control" name="mothers_phone" id="mothers_phone" required autocomplete="off" placeholder="Telepon Ibu">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nisn">NIS</label>
                                                    <input type="number" class="form-control" name="nisn" id="nisn" required autocomplete="off" placeholder="NIS">
                                                </div>
                                                <input type="hidden" name="position" value="Siswa">
                                                <div class="form-group">
                                                    <label for="avatar">Foto</label>
                                                    <input type="file" class="form-control" name="avatar" id="avatar" required>
                                                </div>
                                                <input type="checkbox" id="showPassword_!!" class="show-password" name="showPassword"> <label for="showPassword">Show Password</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- SHOW PASSWORD SCRIPT -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('showPassword').addEventListener('change', function() {
                                        var passwordInput = document.getElementById('password_!');
                                        var confirm_passwordInput = document.getElementById('confirm_password_1');
                                        if (this.checked) {
                                            passwordInput.type = 'text';
                                            confirm_passwordInput.type = 'text';
                                        } else {
                                            passwordInput.type = 'password';
                                            confirm_passwordInput.type = 'password';
                                        }
                                    });
                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('showPassword_!!').addEventListener('change', function() {
                                        var passwordInput = document.getElementById('password_!!');
                                        var confirm_passwordInput = document.getElementById('confirm_password_!!');
                                        if (this.checked) {
                                            passwordInput.type = 'text';
                                            confirm_passwordInput.type = 'text';
                                        } else {
                                            passwordInput.type = 'password';
                                            confirm_passwordInput.type = 'password';
                                        }
                                    });
                                });
                            </script>


                            <table id="data-siswa" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <?php if (session('role') == 1) { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['dataSiswa'] as $siswa) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $siswa->nisn ?></td>
                                            <td><?= $siswa->name ?></td>
                                            <td><?= $siswa->username ?></td>
                                            <td><?= $siswa->birthday ?></td>
                                            <td><?= $siswa->gender ?></td>
                                            <?php if (session('role') == 1) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#editData<?= $siswa->student_id ?>">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="editData<?= $siswa->student_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Siswa</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/editRegSiswa" method="post">
                                                                    <div class="modal-body">
                                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $siswa->student_id ?>">
                                                                        <div class="form-group">
                                                                            <label for="username">Username <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Username">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Password <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="password" class="form-control" name="password" id="password_!!!" autocomplete="off" placeholder="Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="confirm_password">Konfirmasi Password <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password_!!!" autocomplete="off" placeholder="Konfirmasi Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Nama</label>
                                                                            <input type="text" class="form-control" name="name" id="name" required autocomplete="off" placeholder="Nama" value="<?= $siswa->name ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="call">Nama Panggilan</label>
                                                                            <input type="text" class="form-control" name="call" id="call" required autocomplete="off" placeholder="Nama Panggilan" value="<?= $siswa->call ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="gender">Jenis Kelamin</label>
                                                                            <select class="form-control" name="gender" id="gender" required>
                                                                                <option value="Laki - laki" <?= $siswa->gender == 'Laki - laki' ? 'selected' : '' ?>>Laki - laki</option>
                                                                                <option value="Perempuan" <?= $siswa->gender == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="birthday">Tanggal Lahir</label>
                                                                            <input type="date" class="form-control" name="birthday" id="birthday" required autocomplete="off" placeholder="Tanggal Lahir" value="<?= $siswa->birthday ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="address">Alamat</label>
                                                                            <textarea name="address" id="address" required placeholder="Alamat Tempat Tinggal" class="form-control"><?= $siswa->address ?></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="fathers_name">Nama Ayah</label>
                                                                            <input type="text" class="form-control" name="fathers_name" id="fathers_name" required autocomplete="off" placeholder="Nama Ayah" value="<?= $siswa->fathers_name ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="mothers_name">Nama Ibu</label>
                                                                            <input type="text" class="form-control" name="mothers_name" id="mothers_name" required autocomplete="off" placeholder="Nama Ibu" value="<?= $siswa->mothers_name ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="fathers_phone">Telepon Ayah</label>
                                                                            <input type="number" class="form-control" name="fathers_phone" id="fathers_phone" required autocomplete="off" placeholder="Telepon Ayah" value="<?= $siswa->fathers_phone ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="mothers_phone">Telepon Ibu</label>
                                                                            <input type="number" class="form-control" name="mothers_phone" id="mothers_phone" required autocomplete="off" placeholder="Telepon Ibu" value="<?= $siswa->mothers_phone ?>">
                                                                        </div>
                                                                        <input type="checkbox" id="showPassword_!!!" class="show-password" name="showPassword"> <label for="showPassword">Show Password</label>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-danger">Reset</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            document.getElementById('showPassword_!!!').addEventListener('change', function() {
                                                                var passwordInput = document.getElementById('password_!!!');
                                                                var confirm_passwordInput = document.getElementById('confirm_password_!!!');
                                                                if (this.checked) {
                                                                    passwordInput.type = 'text';
                                                                    confirm_passwordInput.type = 'text';
                                                                } else {
                                                                    passwordInput.type = 'password';
                                                                    confirm_passwordInput.type = 'password';
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                    <a href="/delete/<?= $siswa->student_id ?>" class="btn btn-danger m-1" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
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