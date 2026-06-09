<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan - Admin Freshora</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #Ffffff; display: flex; }
        
        .sidebar {
            width: 250px; height: 100vh; background-color: #660055; color: white; position: fixed; padding: 20px;
        }
        .sidebar h2 { text-align: center; margin-bottom: 40px; font-weight: 800; letter-spacing: 1px; }
        .menu-item {
            display: block; padding: 15px; color: #D6B0CA; text-decoration: none; border-radius: 10px; margin-bottom: 5px; transition: 0.3s;
        }
        .menu-item:hover, .menu-item.active { background-color: #8c2b7a; color: white; }
        .menu-item i { width: 25px; }

        .main-content { margin-left: 300px; padding: 40px; width: 100%; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { color: #660055; margin: 0; }

        .table-container {
            background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { color: #660055; font-weight: 700; text-transform: uppercase; font-size: 14px; }
        tr:hover { background-color: #f9f9f9; }
        
        .badge { padding: 5px 12px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .bg-pending { background: #FFF4E5; color: #B76E00; }
        .bg-proses { background: #E3F2FD; color: #0D47A1; }
        .bg-selesai { background: #E8F5E9; color: #1B5E20; }

        .btn-action { padding: 8px 15px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-block; }
        .btn-detail { background: #660055; color: white; }
        .btn-detail:hover { background: #4a003e; }
    </style>
</head>
<body>

    
    <div class="sidebar">
        <h2>FRESHORA</h2>
        <a href="<?= base_url('admin/dashboard') ?>" class="menu-item"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?= base_url('admin/orders') ?>" class="menu-item active"><i class="fas fa-shopping-basket"></i> Pesanan Masuk</a>
        <a href="<?= base_url('admin/messages') ?>" class="menu-item"><i class="fas fa-envelope"></i> Kotak Masuk</a>
        <a href="<?= base_url('admin/settings') ?>"  class="menu-item"><i class="fas fa-cogs"></i> Pengaturan</a>
        <br><br><br><br><br><br><br><br><br>
        <a href="<?= base_url('logout') ?>" class="menu-item" style="margin-top: 50px; color: #ffcccc;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Daftar Pesanan Masuk</h1>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Resi</th>
                        <th>Nama Pelanggan</th>
                        <th>Layanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><strong>#<?= $order['resi_code'] ?></strong></td>
                            <td>
                                <?= $order['fullname'] ?><br>
                                <small style="color: #888;"><?= $order['whatsapp'] ?></small>
                            </td>
                            <td><?= $order['service_name'] ?></td>
                            <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                            <td>
                                <?php 
                                    $badge = 'bg-pending';
                                    if($order['status']=='Proses') $badge='bg-proses';
                                    if($order['status']=='Selesai') $badge='bg-selesai';
                                ?>
                                <span class="badge <?= $badge ?>"><?= $order['status'] ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/order/detail/' . $order['id']) ?>" class="btn-action btn-detail">
    <i class="fas fa-edit"></i> Proses
</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>