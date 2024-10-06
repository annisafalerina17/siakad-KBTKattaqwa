<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper pt-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Guru</h1>
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
                        <li class="breadcrumb-item active">Data Guru</li>
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
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Guru</h5>
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
                                                    <input type="password" class="form-control" name="password" id="passwordddddd" required autocomplete="off" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_passwordddddd" required autocomplete="off" placeholder="Konfirmasi Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" name="name" id="name" required autocomplete="off" placeholder="Nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" required autocomplete="off" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Telepon</label>
                                                    <input type="number" class="form-control" name="phone" id="phone" required autocomplete="off" placeholder="Phone">
                                                </div>
                                                <div class="form-group">
                                                    <label for="position">Posisi</label>
                                                    <select class="form-control" name="position" id="position" required>
                                                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                                                        <option value="Staff">Staff</option>
                                                        <option value="Guru">Guru</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="avatar">Foto</label>
                                                    <input type="file" class="form-control" name="avatar" id="avatar" required>
                                                </div>
                                                <input type="checkbox" id="showPasswordddddd" class="show-password" name="showPassword"> <label for="showPassword">Show Password</label>
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
                                    document.getElementById('showPasswordddddd').addEventListener('change', function() {
                                        var passwordInput = document.getElementById('passwordddddd');
                                        var confirmPasswordInput = document.getElementById('confirm_passwordddddd');
                                        if (this.checked) {
                                            passwordInput.type = 'text';
                                            confirmPasswordInput.type = 'text';
                                        } else {
                                            passwordInput.type = 'password';
                                            confirmPasswordInput.type = 'password';
                                        }
                                    });
                                });
                            </script>

                            <table id="data-guru" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Level</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <?php if (session('role') == 1) { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['dataGuru'] as $guru) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $guru['position'] ?></td>
                                            <td><?= $guru['name'] ?></td>
                                            <td><?= $guru['username'] ?></td>
                                            <td><?= $guru['phone'] ?></td>
                                            <td><?= $guru['email'] ?></td>
                                            <?php if (session('role') == 1) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#editData<?= $guru['id'] ?>">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editData<?= $guru['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Guru</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/editRegGuru" method="post">
                                                                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $guru['id'] ?>">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="username">Username <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Username">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Password <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="password" class="form-control" name="password" id="passworddddddu" autocomplete="off" placeholder="Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="confirm_password">Konfirmasi Password <small>*kosongkan jika tidak ingin diganti</small></label>
                                                                            <input type="password" class="form-control" name="confirm_password" id="confirm_passworddddddu" autocomplete="off" placeholder="Konfirmasi Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Nama</label>
                                                                            <input type="text" class="form-control" name="name" id="name" value="<?= $guru['name'] ?>" required autocomplete="off" placeholder="Nama">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" class="form-control" name="email" id="email" value="<?= $guru['email'] ?>" required autocomplete="off" placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="phone">Telepon</label>
                                                                            <input type="number" class="form-control" name="phone" id="phone" value="<?= $guru['phone'] ?>" required autocomplete="off" placeholder="Phone">
                                                                        </div>
                                                                        <input type="checkbox" id="showPassworddddddu" class="show-password" name="showPassword"> <label for="showPassword">Show Password</label>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-danger">Reset</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- SHOW PASSWORD SCRIPT -->
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            document.getElementById('showPassworddddddu').addEventListener('change', function() {
                                                                var passwordInput = document.getElementById('passworddddddu');
                                                                var confirmPasswordInput = document.getElementById('confirm_passworddddddu');
                                                                if (this.checked) {
                                                                    passwordInput.type = 'text';
                                                                    confirmPasswordInput.type = 'text';
                                                                } else {
                                                                    passwordInput.type = 'password';
                                                                    confirmPasswordInput.type = 'password';
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <?php if ($guru['id'] != session('id')) { ?>
                                                        <a href="/delete/<?= $guru['id'] ?>" class="btn btn-danger m-1" onclick="return confirm('Konfirmasi hapus data!')"><i class="fa-solid fa-trash"></i></a>
                                                    <?php } ?>
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