<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kotak Masuk - Admin Freshmora</title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-page">


    <div class="admin-sidebar">
        <h2>FRESHORA</h2>
        <a href="<?= base_url('admin/dashboard') ?>" class="admin-menu-item"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?= base_url('admin/orders') ?>" class="admin-menu-item"><i class="fas fa-shopping-basket"></i> Pesanan Masuk</a>
        <a href="#" class="admin-menu-item"><i class="fas fa-users"></i> Pelanggan</a>
        
        <a href="<?= base_url('admin/messages') ?>" class="admin-menu-item active" style="background-color: #8c2b7a; color: white;">
            <i class="fas fa-envelope"></i> Kotak Masuk
        </a>
        
        <a href="<?= base_url('admin/settings') ?>" class="admin-menu-item"><i class="fas fa-cogs"></i> Pengaturan</a>
         <br><br><br><br><br><br><br><br><br>
        <a href="<?= base_url('logout') ?>" class="admin-menu-item" style="margin-top: 50px; color: #ffcccc;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="header">
            <h1>Kotak Masuk</h1>
        </div>

        <div class="admin-card" style="max-width: 100%;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee;">
                        <th style="padding: 15px; text-align: left; color: #660055;">Tanggal</th>
                        <th style="padding: 15px; text-align: left; color: #660055;">Nama</th>
                        <th style="padding: 15px; text-align: left; color: #660055;">Pesan</th>
                        <th style="padding: 15px; text-align: left; color: #660055;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($messages)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 30px; color: #999;">Belum ada pesan masuk.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($messages as $msg) : ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px; font-size: 14px;"><?= date('d M Y H:i', strtotime($msg['created_at'])) ?></td>
                                <td style="padding: 15px;">
                                    <strong><?= $msg['name'] ?></strong><br>
                                    <small style="color: #666;"><?= $msg['whatsapp'] ?></small>
                                </td>
                                <td style="padding: 15px; max-width: 400px;"><?= $msg['message'] ?></td>
                                <td style="padding: 15px;">
                                    <a href="https://wa.me/<?= preg_replace('/^0/', '62', $msg['whatsapp']) ?>" target="_blank" class="btn-admin-save" style="padding: 8px 15px; font-size: 12px; width: auto; margin: 0; text-decoration: none;">
                                        <i class="fab fa-whatsapp"></i> Balas
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>