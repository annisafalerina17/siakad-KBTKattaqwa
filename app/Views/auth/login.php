<?= $this->extend('auth/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="text-center my-5">
    <img class="logo" src="<?= base_url('img/logo.png'); ?>" alt="">
    <h3 class="my-3">SISTEM INFORMASI AKADEMIK <br>KB-TK ISLAM AT-TAQWA RAWAMANGUN</h3>
    <div class="card py-3 px-5 m-auto text-start" style="width: 35vw;">
        <h4>LOGIN</h4>

        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('logoutSuccess')) : ?>
            <div class="alert alert-success alert-dismissible fade show my-4" role="alert" id="auto-dismiss-alert">
                <?= session()->getFlashdata('logoutSuccess') ?>
            </div>
        <?php endif ?>

        <form action="/login" method="post">
            <input type="text" class="auth-input" name="username" required autocomplete="off" placeholder="Username">
            <input type="password" class="auth-input" name="password" id="password" required autocomplete="off" placeholder="Password">
            <?php
            $a = rand(1, 5);
            $b = rand(1, 5);
            $res = $a + $b;
            ?>
            <input type="hidden" name="res" value="<?= $res ?>">
            <?= $a ?> + <?= $b ?> = ?
            <input type="number" class="auth-input" name="result" required autocomplete="off" placeholder="Jawaban">
            <input type="checkbox" id="showPassword" class="show-password" name="showPassword"> <label for="showPassword">Show Password</label>
            <div class="text-end">
                <button type="submit" class="auth-btn py-1 px-4">Sign in</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>