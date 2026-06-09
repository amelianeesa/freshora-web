<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Pesanan - Admin Freshmora</title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-page">

    <div class="admin-sidebar">
        <h2>FRESHORA</h2>
        <a href="<?= base_url('admin/dashboard') ?>" class="admin-menu-item"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?= base_url('admin/orders') ?>" class="admin-menu-item active" style="background-color: #8c2b7a; color: white;"><i class="fas fa-shopping-basket"></i> Pesanan Masuk</a>
        <a href="<?= base_url('admin/messages') ?>" class="admin-menu-item"><i class="fas fa-envelope"></i> Kotak Masuk</a>
        <a href="<?= base_url('admin/settings') ?>"  class="admin-menu-item"><i class="fas fa-cogs"></i> Pengaturan</a>
        <a href="<?= base_url('logout') ?>" class="admin-menu-item" style="margin-top: 50px; color: #ffcccc;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="admin-main-content">
        <a href="<?= base_url('admin/orders') ?>" class="btn-admin-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
        
        <div class="admin-card">
            <h2 class="admin-page-title">Proses Pesanan #<?= $order['resi_code'] ?></h2>
            
            <form action="<?= base_url('admin/order/update') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                
                <div class="admin-row-split">
                    
                    <div class="admin-col-left">
                        <h3 style="color:#660055; margin-top:0;">Data Pelanggan</h3>
                        
                        <div class="admin-info-item">
                            <strong>Nama Pelanggan</strong>
                            <span><?= $order['fullname'] ?></span>
                        </div>
                        <div class="admin-info-item">
                            <strong>Layanan Dipilih</strong>
                            <span style="color: #660055; font-weight: bold;"><?= $order['service_name'] ?></span>
                        </div>
                        <div class="admin-info-item">
                            <strong>WhatsApp</strong>
                            <span>
                                <?= $order['whatsapp'] ?> 
                                <a href="https://wa.me/<?= preg_replace('/^0/', '62', $order['whatsapp']) ?>" target="_blank" style="font-size:12px; color:#25D366; text-decoration:none; margin-left:5px;"><i class="fab fa-whatsapp"></i> Chat</a>
                            </span>
                        </div>
                        <div class="admin-info-item">
                            <strong>Alamat Jemput</strong>
                            <span><?= $order['address'] ?></span>
                        </div>
                        
                        <div class="admin-info-item">
                            <strong>Metode Pembayaran</strong>
                            <span class="admin-badge" style="background: #eee; color: #333;"><?= $order['payment_method'] ?? 'COD' ?></span>
                        </div>

                        <?php if($order['payment_method'] != 'Cash'): ?>
                            <div style="margin-top: 15px; margin-bottom: 20px; padding: 15px; background: #d6b0ca; border: 1px solid #ffeeba; border-radius: 10px;">
                                <strong style="display:block; color: #856404; font-size: 13px; margin-bottom: 8px;">
                                    <i class="fas fa-file-invoice-dollar"></i> Bukti Pembayaran
                                </strong>

                                <?php if(!empty($order['payment_proof'])): ?>
                                    <a href="<?= base_url('uploads/payments/' . $order['payment_proof']) ?>" target="_blank">
                                        <img src="<?= base_url('uploads/payments/' . $order['payment_proof']) ?>" style="width: 100%; height: auto; max-height: 200px; object-fit: contain; border-radius: 8px; border: 1px solid #ccc; background: white;">
                                    </a>
                                    <div style="margin-top: 5px; font-size: 12px; color: green; font-weight: bold;">
                                        <i class="fas fa-check-circle"></i> Bukti diterima
                                    </div>
                                    <a href="<?= base_url('uploads/payments/' . $order['payment_proof']) ?>" target="_blank" style="font-size: 11px; text-decoration: underline;">Lihat Ukuran Penuh</a>

                                <?php else: ?>
                                    <div style="color: #856404; font-size: 13px; font-style: italic;">
                                        User belum mengupload bukti pembayaran.
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="admin-info-item">
                            <strong>Catatan</strong>
                            <span><?= $order['notes'] ? $order['notes'] : '-' ?></span>
                        </div>
                    </div>

                    <div class="admin-col-right">
                        <h3 style="color:#660055; margin-top:0;">Input Admin</h3>
                        <input type="hidden" id="serviceType" value="<?= $order['service_name'] ?>">
                        <input type="hidden" id="priceDaily" value="<?= $settings['price_daily'] ?>">
                        <input type="hidden" id="priceExpress" value="<?= $settings['price_express'] ?>">
                        <input type="hidden" id="priceDry" value="<?= $settings['price_dry'] ?>">
                        <input type="hidden" id="priceIron" value="<?= $settings['price_iron'] ?>">
                        <input type="hidden" id="priceComplete" value="<?= $settings['price_complete'] ?>">

                        <label class="admin-label">Berat Cucian (Kg)</label>
                        <input type="number" step="0.1" id="weight" name="weight" class="admin-input" value="<?= $order['weight'] ?>" placeholder="Contoh: 3.5" required oninput="hitungHarga()">

                        <label class="admin-label">Total Harga (Rp)</label>
                        <input type="number" id="total_price" name="total_price" class="admin-input" value="<?= $order['total_price'] ?>" readonly style="background-color: #eee;">
                        
                        <label class="admin-label">Status Pesanan</label>
                        <select name="status" class="admin-select" style="margin-bottom: 20px;">
                            <option value="Pending" <?= $order['status']=='Pending'?'selected':'' ?>>Pending</option>
                            <option value="Proses" <?= $order['status']=='Proses'?'selected':'' ?>>Proses</option>
                            <option value="Selesai" <?= $order['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                        </select>

                        <div style="background: #fff; border: 2px dashed #660055; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                            <label style="display:block; margin-bottom: 10px; color: #660055; font-weight:bold; font-size:12px;">UPLOAD FOTO BUKTI (OPSIONAL)</label>
                            
                            <?php if(!empty($order['laundry_photo'])): ?>
                                <img src="<?= base_url('uploads/laundry/'.$order['laundry_photo']) ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; border: 1px solid #ddd;">
                                <div style="font-size: 11px; color: green; margin-bottom: 10px;"><i class="fas fa-check"></i> Foto tersimpan</div>
                            <?php endif; ?>

                            <input type="file" name="laundry_photo" class="admin-input" accept="image/*" style="padding: 5px;">
                            <small style="display:block; color: #888; font-size: 11px; margin-top: 5px;">
                                Foto cucian yang sudah selesai/dibungkus. Akan muncul di riwayat user.
                            </small>
                        </div>

                        <button type="submit" class="btn-admin-save">SIMPAN PERUBAHAN</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
    function hitungHarga() {
        let berat = parseFloat(document.getElementById('weight').value);
        let layanan = document.getElementById('serviceType').value;
        let hargaPerKg = 0;

        let priceDaily = parseFloat(document.getElementById('priceDaily').value);
        let priceExpress = parseFloat(document.getElementById('priceExpress').value);
        let priceDry = parseFloat(document.getElementById('priceDry').value);
        let priceIron = parseFloat(document.getElementById('priceIron').value);
        let priceComplete = parseFloat(document.getElementById('priceComplete').value);

        if (isNaN(berat) || berat <= 0) {
            document.getElementById('total_price').value = 0;
            return;
        }

        if (layanan === 'Daily Kiloan') { hargaPerKg = priceDaily; } 
        else if (layanan === 'Express Kiloan') { hargaPerKg = priceExpress; } 
        else if (layanan === 'Cuci Kering') { hargaPerKg = priceDry; } 
        else if (layanan === 'Setrika Saja') { hargaPerKg = priceIron; } 
        else if (layanan === 'Cuci dan Setrika') { hargaPerKg = priceComplete; } 
        else { hargaPerKg = priceDaily; } 

        let total = berat * hargaPerKg;
        document.getElementById('total_price').value = total;
    }
    
    document.addEventListener('DOMContentLoaded', hitungHarga);
</script>
</body>
</html>