<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="dashboard-wrapper">
    <div class="dashboard-container">
        
        <div class="profile-card">
            
            <h2 class="dashboard-title">Akun Saya</h2>

            <div class="profile-split-container">
                
                <div class="profile-left-col">
                    <div class="profile-img-wrapper-large">
                        <img src="<?= base_url('uploads/profile/' . ($user['profile_image'] ? $user['profile_image'] : 'default.png')) ?>" alt="Foto Profil">
                    </div>
                    <p class="profile-username-center">@<?= $user['username'] ?></p>
                </div>

                <div class="profile-right-col">
                    
                    <div class="info-group">
                        <label class="info-label">Nama Lengkap</label>
                        <div class="info-value">
                            <?= $user['fullname'] ? $user['fullname'] : '<span class="text-muted">Belum diisi</span>' ?>
                        </div>
                    </div>

                    <div class="info-group">
                        <label class="info-label">Username</label>
                        <div class="info-value">
                            <?= $user['username'] ?>
                        </div>
                    </div>

                    <div class="info-group">
                        <label class="info-label">Nomor WhatsApp</label>
                        <div class="info-value">
                            <?= $user['phone'] ? $user['phone'] : '<span class="text-muted">Belum diisi</span>' ?>
                        </div>
                    </div>

                    <div class="info-group">
                        <label class="info-label">Alamat</label>
                        <div class="info-value address-value">
                            <?= $user['address'] ? $user['address'] : '<span class="text-muted">Belum diisi</span>' ?>
                        </div>
                    </div>
                    
                    <div class="info-group">
                         <label class="info-label">Bergabung Sejak</label>
                         <div class="info-value-simple">
                             <i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($user['created_at'])) ?>
                         </div>
                    </div>

                </div>
            </div>
            <hr class="divider" style="margin-top: 30px;">


            <div class="profile-actions-grid">
                <a href="<?= base_url('profile') ?>" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
                <a href="<?= base_url('history') ?>" class="btn-action btn-history">
                    <i class="fas fa-history"></i> Riwayat Pesanan
                </a>
                <a href="<?= base_url('logout') ?>" class="btn-action btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>
