<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="page-banner">
    <h1>Form Pemesanan</h1>
</section>
<div style="background-color: #FFFFFF; min-height: 80vh; padding: 50px 20px; display: flex; justify-content: center; align-items: center; font-family: 'Poppins', sans-serif;">

    <div style="background: white; padding: 40px; border-radius: 20px; max-width: 500px; width: 100%; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee; border-top: 5px solid #660066;">
        
        <div style="width: 80px; height: 80px; background: #d4edda; color: #155724; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 40px;">
            <i class="fas fa-check"></i>
        </div>

        <h2 style="color: #660066; margin-bottom: 10px; font-weight: 700;">Pemesanan Berhasil!</h2>
        <p style="color: #666; margin-bottom: 30px;">Terima kasih telah memesan. Tim kami akan segera memproses pesanan Anda.</p>

        <div style="background: #fdfdfd; border: 2px dashed #660066; padding: 20px; border-radius: 15px; margin-bottom: 30px;">
            <p style="margin: 0; font-size: 14px; color: #888;">Kode Resi Anda:</p>
            <h1 style="margin: 10px 0; font-size: 36px; color: #660066; letter-spacing: 2px; font-weight: 800;">
                <?= $resi ?>
            </h1>
            <p style="margin: 0; font-size: 12px; color: #888;">*Simpan kode ini untuk melacak status pesanan</p>
        </div>

        <div style="display: flex; gap: 10px; justify-content: center;">
            <a href="<?= base_url('/') ?>" style="text-decoration: none; background: #ddd; color: #333; padding: 12px 20px; border-radius: 50px; font-weight: bold; font-size: 14px;">Kembali ke Home</a>
            
            <a href="<?= base_url('tracking') ?>" style="text-decoration: none; background: #660066; color: white; padding: 12px 20px; border-radius: 50px; font-weight: bold; font-size: 14px;">Lacak Pesanan</a>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>