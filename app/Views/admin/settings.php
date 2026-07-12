<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan - Admin Freshmora</title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-page">

    <div class="admin-sidebar">
        <h2>FRESHORA</h2>
        <a href="<?= base_url('admin/dashboard') ?>" class="admin-menu-item"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?= base_url('admin/orders') ?>" class="admin-menu-item"><i class="fas fa-shopping-basket"></i> Pesanan Masuk</a>
        <a href="<?= base_url('admin/messages') ?>" class="admin-menu-item"><i class="fas fa-envelope"></i> Kotak Masuk</a>
        <a href="<?= base_url('admin/settings') ?>" class="admin-menu-item active" style="background-color: #8c2b7a; color: white;">
            <i class="fas fa-cog"></i> Pengaturan
        </a>

        <a href="<?= base_url('logout') ?>" class="admin-menu-item" style="margin-top: 50px; color: #ffcccc;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="admin-main-content">
        
        <h2 class="admin-page-title">Pengaturan Sistem</h2>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="admin-row-split">
            
            <div class="admin-col-left" style="flex: 2;">
                <div class="admin-card">
                    <h3 style="color: #660055; margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                        <i class="fas fa-store"></i> Info Toko & Harga
                    </h3>

                    <form action="<?= base_url('admin/settings/update') ?>" method="post" enctype="multipart/form-data">
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div>
                                <label class="admin-label">Harga Daily Kiloan (/kg)</label>
                                <input type="number" name="price_daily" class="admin-input" value="<?= $settings['price_daily'] ?>" required>
                            </div>
                            <div>
                                <label class="admin-label">Harga Express Kiloan (/kg)</label>
                                <input type="number" name="price_express" class="admin-input" value="<?= $settings['price_express'] ?>" required>
                            </div>
                            <div>
                                <label class="admin-label">Harga Cuci Kering (/kg)</label>
                                <input type="number" name="price_dry" class="admin-input" value="<?= $settings['price_dry'] ?>" required>
                            </div>
                            <div>
                                <label class="admin-label">Harga Setrika Saja (/kg)</label>
                                <input type="number" name="price_iron" class="admin-input" value="<?= $settings['price_iron'] ?>" required>
                            </div>
                            <div>
                                <label class="admin-label">Harga Cuci dan Setrika (/kg)</label>
                                <input type="number" name="price_complete" class="admin-input" value="<?= $settings['price_complete'] ?>" required>
                            </div>
                        </div>

                        <hr style="border: 0; border-top: 1px dashed #ccc; margin: 20px 0;">

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div>
                                <label class="admin-label">Nama Bank</label>
                                <input type="text" name="bank_name" class="admin-input" value="<?= $settings['bank_name'] ?>" placeholder="Contoh: BNI">
                            </div>
                            <div>
                                <label class="admin-label">Nomor Rekening</label>
                                <input type="text" name="bank_number" class="admin-input" value="<?= $settings['bank_number'] ?>">
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <label class="admin-label">Atas Nama Rekening</label>
                            <input type="text" name="bank_holder" class="admin-input" value="<?= $settings['bank_holder'] ?>">
                        </div>

                        <div style="margin-top: 20px;">
                            <label class="admin-label">Nomor WhatsApp Admin</label>
                            <input type="text" name="whatsapp_admin" class="admin-input" value="<?= $settings['whatsapp_admin'] ?>" placeholder="628...">
                        </div>

                        <button type="submit" class="btn-admin-save" style="margin-top: 20px;">
                            <i class="fas fa-save"></i> Simpan Pengaturan
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-col-right" style="flex: 1;">
                <div class="admin-card">
                    <h3 style="color: #660055; margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                        <i class="fas fa-lock"></i> Ganti Password
                    </h3>

                    <form action="<?= base_url('admin/password/update') ?>" method="post">
                        
                        <label class="admin-label">Password Lama</label>
                        <input type="password" name="old_password" class="admin-input" required placeholder="***">

                        <label class="admin-label">Password Baru</label>
                        <input type="password" name="new_password" class="admin-input" required placeholder="Minimal 6 karakter">

                        <label class="admin-label">Ulangi Password Baru</label>
                        <input type="password" name="confirm_password" class="admin-input" required placeholder="Harus sama">

                        <button type="submit" class="btn-admin-save" style="background-color: #333; margin-top: 20px;">
                            <i class="fas fa-key"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div class="admin-row-split" style="margin-top: 30px;">
            <div class="admin-col-left" style="flex: 1;">
                <div class="admin-card">
                    <h3 style="color: #660055; margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                        <i class="fas fa-images"></i> Kelola Banner Aplikasi
                    </h3>

                    <form action="<?= base_url('admin/banner/add') ?>" method="post" enctype="multipart/form-data">
                        <label class="admin-label">Upload Banner Baru (Bisa Pilih Banyak Sekaligus)</label>
                        <input type="file" name="banner_images[]" class="admin-input" accept="image/*" multiple required>
                        <button type="submit" class="btn-admin-save" style="margin-top: 10px;">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </form>

                    <hr style="border: 0; border-top: 1px dashed #ccc; margin: 20px 0;">

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
                        <?php if(!empty($banners)): ?>
                            <?php foreach($banners as $b): ?>
                                <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative;">
                                    <img src="<?= base_url('uploads/banners/' . $b['image']) ?>" alt="Banner" style="width: 100%; height: 120px; object-fit: cover;">
                                    <a href="<?= base_url('admin/banner/delete/' . $b['id']) ?>" onclick="return confirm('Hapus banner ini?')" style="position: absolute; top: 5px; right: 5px; background: red; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-size: 12px;">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: #888; font-size: 14px;">Belum ada banner.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>