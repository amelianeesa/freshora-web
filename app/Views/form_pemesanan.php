<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="page-banner">
    <h1>Form Pemesanan</h1>
</section>

<div class="contact-page-wrapper">
    <div class="contact-container">

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert-error" style="max-width: 500px; margin: 0 auto 20px;">
                <strong>Mohon Periksa Kembali:</strong>
                <ul style="margin-left: 20px; margin-top: 5px;">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="contact-form-card-centered" style="max-width: 1000px !important;">

            <form action="<?= base_url('pemesanan/kirim') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="layanan" class="label-bold">Jenis Layanan</label>
                    <select id="layanan" name="layanan" class="input-beige-rounded" required style="cursor: pointer;">
                        <option value="" disabled <?= empty($layanan_terpilih) ? 'selected' : '' ?>>Pilih Layanan...</option>
                        <option value="Daily Kiloan" <?= (isset($layanan_terpilih) && $layanan_terpilih == 'Daily Kiloan') ? 'selected' : '' ?>>Daily Kiloan</option>
                        <option value="Express Kiloan" <?= (isset($layanan_terpilih) && $layanan_terpilih == 'Express Kiloan') ? 'selected' : '' ?>>Express Kiloan</option>
                        <option value="Cuci Kering" <?= (isset($layanan_terpilih) && $layanan_terpilih == 'Cuci Kering') ? 'selected' : '' ?>>Cuci Kering</option>
                        <option value="Setrika Saja" <?= (isset($layanan_terpilih) && $layanan_terpilih == 'Setrika Saja') ? 'selected' : '' ?>>Setrika Saja</option>
                        <option value="Cuci dan Setrika" <?= (isset($layanan_terpilih) && $layanan_terpilih == 'Cuci dan Setrika') ? 'selected' : '' ?>>Cuci & Setrika</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="nama" class="label-bold">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="<?= old('nama') ?>" class="input-beige-rounded" placeholder="Masukkan Nama Lengkap" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="whatsapp" class="label-bold">Nomor WhatsApp</label>
                    <input type="tel" id="whatsapp" name="whatsapp" value="<?= old('whatsapp') ?>" class="input-beige-rounded" placeholder="Contoh: 0812..." required>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="alamat" class="label-bold">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="3" class="input-beige-rounded" placeholder="Jalan, Nomor Rumah, Patokan..." required><?= old('alamat') ?></textarea>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="jam" class="label-bold">Jam Pengambilan</label>
                    <input type="time" id="jam" name="jam_pengambilan" value="<?= old('jam_pengambilan') ?>" class="input-beige-rounded" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="catatan" class="label-bold">Catatan Tambahan</label>
                    <textarea id="catatan" name="catatan_tambahan" rows="2" class="input-beige-rounded" placeholder="(Opsional)"><?= old('catatan_tambahan') ?></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="payment" class="label-bold">Metode Pembayaran</label>
                    <select id="payment" name="payment_method" class="input-beige-rounded" required style="cursor: pointer;">
                        <option value="" disabled selected>Pilih Metode...</option>
                        <option value="Cash" <?= old('payment_method') == 'Cash' ? 'selected' : '' ?>>Cash / Tunai</option>
                        <option value="Transfer" <?= old('payment_method') == 'Transfer' ? 'selected' : '' ?>>Transfer Bank</option>
                        <option value="QRIS" <?= old('payment_method') == 'QRIS' ? 'selected' : '' ?>>QRIS (Scan Barcode)</option>
                    </select>
                </div>

                <button type="submit" class="btn-purple-block">Kirim Pesanan</button>
                
            </form>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>
