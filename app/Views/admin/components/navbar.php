<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?= base_url(''); ?>/avatar/<?= session('avatar') ?>" class="img-circle mr-2" style="width: 25px;" alt="<?= session('name') ?>"><?= session('name') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- PROFIL -->
                    <li class="nav-item">
                        <a href="/admin/profil" class="nav-link">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p style="font-size: 13px;">
                                Profil
                            </p>
                        </a>
                    </li>

                    <!-- CHANGE PASSWORD -->
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#resetPassword<?= session('id') ?>">
                            <i class="nav-icon fa-solid fa-lock"></i>
                            <p style="font-size: 13px;">
                                Ubah Password
                            </p>
                        </a>
                    </li>

                    <!-- SIGN OUT -->
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                            <p style="font-size: 13px;">
                                Sign Out
                            </p>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- Modal Reset Password -->
<div class="modal fade" id="resetPassword<?= session('id') ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reset Password <?= session('name') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/resetPassword" method="post">
                <input type="hidden" name="id" value="<?= session('id') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required autocomplete="off" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required autocomplete="off" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirm_password");
        if (password.type === "password") {
            password.type = "text";
            confirmPassword.type = "text";
        } else {
            password.type = "password";
            confirmPassword.type = "password";
        }
    }
</script>