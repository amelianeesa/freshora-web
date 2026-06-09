<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?= base_url('/') ?>">
    <title>Freshora - Layanan Laundry</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    </head>
<body>

    <nav class="navbar shadow"> <div class="container-fluid">

        <a class="navbar-brand" href="<?= base_url('/') ?>">
          <img src="<?= base_url('assets/images/logo.png') ?>" alt="FRESHORA Logo" style="height: 50px;">
          </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('service') ?>">Layanan</a><li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('tracking') ?>">Lacak Status Cucian</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Hubungi Kami</a></li>
            <li class="dropdown">
              <a href="#" class="dropbtn">
                <?php if (session()->get('isLoggedIn')) : ?> Hi, <?= session()->get('username') ?>
                <?php else : ?> Akun
                <?php endif; ?> <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 5px;"></i>
              </a>
              
              <div class="dropdown-content">
                <?php if (session()->get('isLoggedIn')) : ?>
                 <a href="<?= base_url('account') ?>"> <i class="fas fa-user"></i> Akun Saya </a>
                  <a href="<?= base_url('history') ?>"> <i class="fas fa-history"></i> Riwayat Pemesanan </a>
                    <hr style="margin: 0; border: 0; border-top: 1px solid rgba(102, 0, 102, 0.1);">
                    <a href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  <?php else : ?>
                    <a href="<?= base_url('login') ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
                  <?php endif; ?>
              </div>
              </li>
          </ul>
        </div>
    </nav>