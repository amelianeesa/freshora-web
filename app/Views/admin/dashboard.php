<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Freshora</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #Ffffff; display: flex; }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #660055; 
            color: white;
            position: fixed;
            padding: 20px;
        }
        .sidebar h2 { text-align: center; margin-bottom: 40px; font-weight: 800; letter-spacing: 1px; }
        .menu-item {
            display: block;
            padding: 15px;
            color: #D6B0CA; 
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: 0.3s;
        }
        .menu-item:hover, .menu-item.active {
            background-color: #8c2b7a;
            color: white;
        }
        .menu-item i { width: 25px; }

        .main-content {
            margin-left: 300px; 
            width: calc(100% - 250px);
            padding: 40px;
            width: 100%;
        }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { color: #660055; margin: 0; }
        .admin-profile { display: flex; align-items: center; gap: 10px; color: #660055; font-weight: bold; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .card-icon {
            width: 60px; height: 60px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
        }
        .bg-orange { background: #FFF4E5; color: #ff9800; }
        .bg-blue { background: #E3F2FD; color: #2196F3; }
        .bg-green { background: #E8F5E9; color: #4CAF50; }
        .bg-purple { background: #f3e5f5; color: #9c27b0; }

        .card-info h3 { margin: 0; font-size: 28px; color: #333; }
        .card-info p { margin: 0; color: #888; font-size: 14px; }

    </style>
</head>
<body>

    <div class="sidebar">
        <h2>FRESHORA</h2>
        <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="<?= base_url('admin/orders') ?>" class="menu-item">
            <i class="fas fa-shopping-basket"></i> Pesanan Masuk
        </a>    
        <a href="<?= base_url('admin/messages') ?>" class="menu-item">
            <i class="fas fa-envelope"></i> Kotak Masuk
        </a>

        <a href="<?= base_url('admin/settings') ?>" class="menu-item">
            <i class="fas fa-cogs"></i> Pengaturan
        </a>
        <br><br><br><br><br><br><br><br><br>
        <a href="<?= base_url('logout') ?>" class="menu-item" style="margin-top: 50px; color: #ffcccc;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="main-content">
        
        <div class="header">
            <h1>Dashboard Admin</h1>
            <div class="admin-profile">
                <span>Halo, Admin!</span>
                <div style="width: 40px; height: 40px; background: #660055; border-radius: 50%;"></div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="card">
                <div class="card-icon bg-orange"><i class="fas fa-clock"></i></div>
                <div class="card-info">
                    <h3><?= $count_pending ?></h3>
                    <p>Pesanan Baru</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon bg-blue"><i class="fas fa-soap"></i></div>
                <div class="card-info">
                    <h3><?= $count_proses ?></h3>
                    <p>Sedang Dicuci</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon bg-green"><i class="fas fa-check-circle"></i></div>
                <div class="card-info">
                    <h3><?= $count_selesai ?></h3>
                    <p>Selesai</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon bg-purple"><i class="fas fa-wallet"></i></div>
                <div class="card-info">
                    <h3 style="font-size: 20px;">Rp <?= number_format($income, 0, ',', '.') ?></h3>
                    <p>Total Pendapatan</p>
                </div>
            </div>
        </div>

        <div class="recent-orders-container" style="margin-top: 40px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; color: #660055;">Pesanan Terbaru</h3>
                <a href="<?= base_url('admin/orders') ?>" style="color: #660055; text-decoration: none; font-size: 14px; font-weight: 600;">Lihat Semua <i class="fas fa-arrow-right"></i></a>
            </div>

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #f0f0f0;">
                        <th style="padding: 15px; color: #888; font-size: 14px;">No Resi</th>
                        <th style="padding: 15px; color: #888; font-size: 14px;">Pelanggan</th>
                        <th style="padding: 15px; color: #888; font-size: 14px;">Layanan</th>
                        <th style="padding: 15px; color: #888; font-size: 14px;">Status</th>
                        <th style="padding: 15px; color: #888; font-size: 14px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($latest_orders)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: #ccc;">
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($latest_orders as $order): ?>
                            <tr style="border-bottom: 1px solid #f9f9f9;">
                                <td style="padding: 15px; font-weight: bold; color: #333;">
                                    #<?= $order['resi_code'] ?>
                                    <br>
                                    <small style="color: #ccc; font-weight: normal; font-size: 11px;"><?= date('d M H:i', strtotime($order['created_at'])) ?></small>
                                </td>
                                <td style="padding: 15px;">
                                    <?= $order['fullname'] ?>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #faf0f6; color: #660055; padding: 5px 10px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                        <?= $order['service_name'] ?>
                                    </span>
                                </td>
                                <td style="padding: 15px;">
                                    <?php 
                                        $statusColor = '#ccc';
                                        if($order['status'] == 'Pending') $statusColor = '#ffc107'; // Kuning
                                        if($order['status'] == 'Proses') $statusColor = '#17a2b8';  // Biru
                                        if($order['status'] == 'Selesai') $statusColor = '#28a745'; // Hijau
                                    ?>
                                    <span style="color: <?= $statusColor ?>; font-weight: bold; display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-circle" style="font-size: 8px;"></i> <?= $order['status'] ?>
                                    </span>
                                </td>
                                <td style="padding: 15px; text-align: right;">
                                    <a href="<?= base_url('admin/order/detail/' . $order['id']) ?>" style="background: #660055; color: white; padding: 8px 15px; border-radius: 8px; text-decoration: none; font-size: 12px; transition: 0.3s;">
                                        Proses <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 3px;"></i>
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