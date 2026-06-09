<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="history-page-wrapper">
    
    <div class="history-header">
        <a href="<?= base_url('account') ?>" class="btn-back-pill">
            <i class="fas fa-arrow-left"></i> Kembali Ke Akun
        </a>
        <h2 class="history-title">Riwayat Laundry</h2>
    </div>

    <div class="history-card-container">

        <?php if (empty($orders)) : ?>
            <div class="history-card" style="justify-content: center; color: #888; flex-direction: column; text-align: center;">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="80" style="opacity: 0.5; margin-bottom: 10px;">
                <p>Belum ada riwayat pemesanan.</p>
            </div>
        <?php else : ?>

            <?php foreach ($orders as $o) : ?>
                <div class="history-card">
                    
                    <div class="history-img-box">
                        <?php if (!empty($o['laundry_photo'])) : ?>
                            <img src="<?= base_url('uploads/laundry/' . $o['laundry_photo']) ?>" 
                                 alt="Bukti Laundry" 
                                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid #660055; padding: 2px;">
                        <?php else : ?>
                            <?php 
                                // Pilih ikon berdasarkan layanan biar variatif
                                $icon = 'https://cdn-icons-png.flaticon.com/512/3322/3322056.png'; // Default
                                if($o['service_name'] == 'Cuci Kering') $icon = 'https://cdn-icons-png.flaticon.com/512/3322/3322083.png'; 
                                if($o['service_name'] == 'Setrika Saja') $icon = 'https://cdn-icons-png.flaticon.com/512/2316/2316680.png'; 
                            ?>
                            <img src="<?= $icon ?>" alt="Icon Layanan">
                        <?php endif; ?>
                    </div>

                    <div class="history-details">
                        
                        <div class="detail-row">
                            <span class="detail-label">No Order</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value">#<?= $o['resi_code'] ?></span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Tanggal Laundry</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value"><?= date('d F Y', strtotime($o['created_at'])) ?></span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Jenis Layanan</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value"><?= $o['service_name'] ?></span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Berat Cucian</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value">
                                <?= ($o['weight'] > 0) ? $o['weight'] . ' Kg' : '-' ?>
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Total Bayar</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" style="color: #660055; font-size: 16px;">
                                <?= ($o['total_price'] > 0) ? 'Rp ' . number_format($o['total_price'], 0, ',', '.') : 'Menunggu Penimbangan' ?>
                            </span>
                        </div>

                        <div style="margin-top: 10px;">
                            <?php 
                                $bgStatus = '#ccc';
                                if($o['status']=='Proses') $bgStatus = '#ffc107'; // Kuning
                                if($o['status']=='Selesai') $bgStatus = '#28a745'; // Hijau
                            ?>
                            <span style="background: <?= $bgStatus ?>; color: white; padding: 5px 15px; border-radius: 50px; font-size: 12px; font-weight: bold;">
                                <?= $o['status'] ?>
                            </span>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>