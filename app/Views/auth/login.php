<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Freshora</title>
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-left">
            <img src="<?= base_url('assets/images/logologin.png') ?>" alt="Freshora Logo">
            <h2>Cucian Bersih, Hidup Beres</h2> 
        </div>

        <div class="login-right">
            <div class="login-form-card">
                <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert-error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
                <h2>Log in</h2>
                
                <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="login-button">LOG IN</button>
                </form>

                <div class="signup-link">
                    Don't have an account? <a href="<?= base_url('register') ?>">Sign up here</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>