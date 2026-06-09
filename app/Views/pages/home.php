<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="hero-section">
    <div class="purple-shape"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 hero-content">
                <h1>Always Fresh,<br>Always Ready</h1>
                <p>Layanan laundry premium berbasis antar-jemput yang menjamin pakaian Anda bersih sempurna, tepat waktu, dan bebas ribet.</p>
                <a href="<?= base_url('service') ?>" class="btn-hero">Get Started</a>
            </div>
            <div class="col-lg-6 hero-image-container">
                <img src="<?= base_url('assets/images/mesin-cuci.png') ?>" alt="Mesin Cuci Laundry">
            </div>
            
        </div>
    </div>

    <div class="stats-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-4 stat-item">
                    <strong>2023</strong>
                    <span>sejak</span>
                </div>
                <div class="col-md-4 stat-item">
                    <strong>8</strong>
                    <span>Tim</span>
                </div>
                <div class="col-md-4 stat-item">
                    <strong>850+</strong>
                    <span>Pesanan Selesai</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Layanan Kami</h2>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-card-img">
                        <img src="<?= base_url('assets/images/daily-kiloan.jpeg') ?>" alt="Daily Kiloan">
                    </div>
                    <div class="service-card-footer">
                        <h5>Daily Kiloan</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-card-img">
                        <img src="<?= base_url('assets/images/cuset.jpeg') ?>" alt="Cuci & Setrika">
                    </div>
                    <div class="service-card-footer">
                        <h5>Cuci & Setrika</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-card-img">
                        <img src="<?= base_url('assets/images/setrika.jpeg') ?>" alt="Setrika Saja">
                    </div>
                    <div class="service-card-footer">
                        <h5>Setrika Saja</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-card-img">
                        <img src="<?= base_url('assets/images/expresskiloan.jpeg') ?>" alt="Express Kiloan">
                    </div>
                    <div class="service-card-footer">
                        <h5>Express Kiloan</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-card-img">
                        <img src="<?= base_url('assets/images/cuker.jpeg') ?>" alt="Cuci Kering">
                    </div>
                    <div class="service-card-footer">
                        <h5>Cuci Kering</h5>
                    </div>
                </div>
            </div>

        </div> </div> 
    </section>

    <section class="why-choose-us-section">
    <div class="container">
        
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Why Choose Us</h2>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-card-icon">
                        </div>
                    <h5>Cepat dan Tepat Waktu</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-card-icon"></div>
                    <h5>Hemat Waktu dan Tenaga</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-card-icon"></div>
                    <h5>Perawatan Profesional</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class_G="why-card"> <div class="why-card"> <div class="why-card-icon"></div>
                    <h5>Kualitas Hasil Cucian yang Lebih Baik</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                </div>
            </div>

        </div> </div> 
    </section>

    <section class="get-in-touch-section">
    <div class="container">
        
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Get In Touch</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8"> <form action="#" method="post"> <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">No WhatsApp</label>
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit-custom">Send Message</button>
                    </div>
                </form>
            </div>
        </div> </div> </section>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>