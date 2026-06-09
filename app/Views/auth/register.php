<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Freshmora</title>
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-left">
            <img src="<?= base_url('assets/images/logologin.png') ?>" alt="Freshora Logo">
            <h2>Gabung Bersama Kami</h2> 
        </div>

        <div class="login-right">
            <div class="login-form-card">
                <h2>Sign Up</h2>
                
                <?php if(session()->getFlashdata('errors')): ?>
                    <div style="color: red; font-size: 14px; margin-bottom: 10px; text-align: left;">
                        <?= implode('<br>', session()->getFlashdata('errors')) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('auth/attemptRegister') ?>" method="post">
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Buat username baru" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Buat password kuat" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="pass_confirm">Konfirmasi Password</label>
                        <input type="password" id="pass_confirm" name="pass_confirm" placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="login-button">DAFTAR SEKARANG</button>
                </form>

                <div class="signup-link">
                    Already have an account? <a href="<?= base_url('login') ?>">Log in here</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>