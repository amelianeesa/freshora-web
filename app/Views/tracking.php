<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="page-banner">
    <h1>Lacak Status Cucianmu</h1>
</section>

<div class="tracking-wrapper">
    
    <div class="tracking-card">
        <h2 class="tracking-title">Lacak Pesanan</h2>
        <p style="color: #666; margin-bottom: 30px;">Masukkan kode resi Anda (Contoh: TRX-XXXXX)</p>

        <form action="<?= base_url('tracking/cari') ?>" method="post">
            <div class="search-box">
                <input type="text" name="resi" class="input-resi" placeholder="Masukkan Kode Resi..." required value="<?= isset($resi) ? $resi : '' ?>">
                <button type="submit" class="btn-lacak">Cari</button>
            </div>
        </form>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error" style="margin-top: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($order)) : ?>
            
            <div style="margin-top: 50px; text-align: left;">
                
                <div class="tracking-result-card" style="margin-bottom: 30px;">
                    <div class="result-header">
                        <h3 class="order-id">ORDER #<?= $order['resi_code'] ?></h3>
                        <p class="service-type">Jenis Layanan: <?= $order['service_name'] ?></p>
                    </div>

                    <div class="timeline-container">
                        <div class="timeline-line-bg"></div>
                        <?php 
                            $progressWidth = '0%';
                            if ($order['status'] == 'Pending') $progressWidth = '0%'; 
                            if ($order['status'] == 'Proses') $progressWidth = '50%'; 
                            if ($order['status'] == 'Selesai') $progressWidth = '100%'; 
                        ?>
                        <div class="timeline-line-active" style="width: <?= $progressWidth ?>;"></div>

                        <div class="timeline-step step-active">
                            <div class="step-icon"><i class="fas fa-check"></i></div>
                            <div class="step-label">Pesanan<br>Diterima</div>
                        </div>
                        <div class="timeline-step <?= ($order['status'] == 'Proses' || $order['status'] == 'Selesai') ? 'step-active' : '' ?>">
                            <div class="step-icon"><i class="fas fa-soap"></i></div>
                            <div class="step-label">Dicuci</div>
                        </div>
                        <div class="timeline-step <?= ($order['status'] == 'Selesai') ? 'step-active' : '' ?>">
                            <div class="step-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="step-label">Pesanan<br>Selesai</div>
                        </div>
                    </div>
                </div>

                <div class="result-box">
                    <h4 style="color: #660055; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">Rincian Data</h4>
                    
                    <?php 
                        $badgeClass = 'badge-pending';
                        if($order['status'] == 'Proses') $badgeClass = 'badge-process';
                        if($order['status'] == 'Selesai') $badgeClass = 'badge-success';
                    ?>
                    <div style="margin-bottom: 20px;">
                        <span class="order-status <?= $badgeClass ?>">Status: <?= $order['status'] ?></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nama Pelanggan</span>
                        <span class="info-value"><?= $order['fullname'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jam Pengambilan</span>
                        <span class="info-value"><?= $order['pickup_time'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat Jemput</span>
                        <span class="info-value" style="text-align: right; max-width: 60%;"><?= $order['address'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Metode Pembayaran</span>
                        <span class="info-value"><?= $order['payment_method'] ?? '-' ?></span>
                    </div>

                    <?php if ($order['total_price'] > 0) : ?>
                        <div class="bill-box">
                            <p class="bill-title">Total Tagihan (<?= $order['weight'] ?> Kg)</p>
                            <h2 class="bill-amount">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></h2>
                            <hr class="bill-divider">

                            <?php if ($order['payment_method'] == 'Transfer') : ?>
                                <div class="payment-details">
                                    <p>Silakan Transfer ke:</p>
                                    <div class="bank-card">
                                        <div><strong>BNI: 1846646794</strong><br><small>a.n Freshora Laundry</small></div>
                                    </div>
                                    <a href="https://wa.me/6282313051938?text=Halo..." target="_blank" class="btn-wa-confirm" style="font-size: 12px; margin-bottom: 15px;">
                                        <i class="fab fa-whatsapp"></i> Chat Admin
                                    </a>
                                </div>
                            <?php elseif ($order['payment_method'] == 'QRIS') : ?>
                                <div class="payment-details center">
                                    <p>Scan QRIS untuk Membayar</p>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Bayar Rp <?= $order['total_price'] ?>" class="qris-img">
                                    <br><small>NMID: FRESHORA Laundry</small>
                                </div>
                            <?php else : ?>
                                <div class="payment-details cash-alert">
                                    <i class="fas fa-wallet"></i>
                                    <div>
                                        <strong>Siapkan Uang Tunai</strong><br>
                                        <small>Mohon siapkan uang pas saat kurir datang.</small>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($order['payment_method'] != 'Cash') : ?>
                                <div style="margin-top: 20px; padding-top: 15px; border-top: 1px dashed #ddd;">
                                    
                                    <?php if (empty($order['payment_proof'])) : ?>
                                        <h4 style="font-size: 14px; color: #660055; margin-bottom: 10px; text-align: center;">
                                            <i class="fas fa-camera"></i> Upload Bukti Pembayaran
                                        </h4>
                                        
                                        <form action="<?= base_url('transaksi/upload_bukti') ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            
                                            <input type="file" name="bukti_bayar" class="input-beige-rounded" accept="image/*" required style="padding: 8px; font-size: 12px; width: 100%; margin-bottom: 10px;">
                                            
                                            <button type="submit" style="background-color: #660055; color: white; border: none; padding: 10px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; transition: 0.3s;">
                                                <i class="fas fa-paper-plane"></i> Kirim Bukti
                                            </button>
                                        </form>

                                    <?php else : ?>
                                        <div style="background: #e8f5e9; padding: 15px; border-radius: 10px; color: #2e7d32; text-align: center;">
                                            <i class="fas fa-check-circle" style="font-size: 24px; margin-bottom: 5px;"></i><br>
                                            <strong>Bukti Terkirim!</strong><br>
                                            <small>Admin sedang memverifikasi.</small>
                                            <div style="margin-top: 5px;">
                                                <a href="<?= base_url('uploads/payments/' . $order['payment_proof']) ?>" target="_blank" style="text-decoration: underline; color: #1b5e20; font-size: 12px;">Lihat Foto</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                            </div>
                    <?php else : ?>
                        <div class="waiting-box">
                            <i class="fas fa-scale-balanced"></i>
                            <p>Menunggu penimbangan...</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>