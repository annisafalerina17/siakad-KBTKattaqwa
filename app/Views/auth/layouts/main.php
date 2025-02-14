<?php
$session = \Config\Services::session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD | <?= $data['title'] ?></title>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon.png'); ?>">
    <link rel="manifest" href="<?= base_url('favicon.png'); ?>">

    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- AUTH CSS -->
    <link rel="stylesheet" href="<?= base_url('css/auth.css'); ?>">
</head>

<body>
    <?= $this->renderSection('content'); ?>

    <!-- BOOSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SHOW PASSWORD -->
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            var confirm_passwordInput = document.getElementById('confirm_password');
            if (this.checked) {
                passwordInput.type = 'text';
                confirm_passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirm_passwordInput.type = 'password';
            }
        });
    </script>
    <script>
        // Menunggu 3 detik (3000 milidetik) lalu menghilangkan alert
        setTimeout(function() {
            var alertElement = document.getElementById('auto-dismiss-alert');
            if (alertElement) {
                // Menghilangkan alert dengan Bootstrap's JavaScript API
                $(alertElement).alert('close');
            }
        }, 3000);
    </script>
</body>

</html>