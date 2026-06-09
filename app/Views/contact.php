<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<section class="page-banner">
    <h1>Contact Us</h1>
</section>

<div class="contact-page-wrapper">
     

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert-success" style="max-width: 600px; margin: 40px auto 20px; background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error" style="max-width: 600px; margin: 40px auto 20px; background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>


        <div class="contact-form-card-centered">
            
            <div class="form-header-center">
                <h2>Message</h2>
                <p>Kirim pesan kepada kami via WhatsApp</p>
            </div>

            <form action="<?= base_url('contact/send') ?>" method="post">
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name" class="label-bold">Name</label>
                    <input type="text" id="name" name="name" class="input-beige-rounded" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="whatsapp" class="label-bold">No WhatsApp</label>
                    <input type="tel" id="whatsapp" name="whatsapp" class="input-beige-rounded" placeholder="Cth: 081234567890" required>
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="message" class="label-bold">Message</label>
                    <textarea id="message" name="message" rows="5" class="input-beige-rounded" placeholder="Tuliskan pesan..." required></textarea>
                </div>

                <button type="submit" class="btn-purple-block">Send Message</button>

            </form>

        </div>
        </div>
    </div>
<div class="map-full-screen">
        <iframe 
            src="https://maps.google.com/maps?q=Politeknik%20Negeri%20Cilacap%2C%20Indonesia&t=&z=15&ie=UTF8&iwloc=&output=embed"
            width="100%" 
            height="450" 
            style="border:0; display: block;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>
