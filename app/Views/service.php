<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    :root {
        --color-purple: #660055;
        --color-beige: #F0E7D5;
        --color-icon-bg: #D6A8D1; 
        --color-text-dark: #333;
    }

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
    }


    .service-banner {
        background-image: url('<?= base_url('assets/images/buble.jpeg') ?>'); 
        background-size: cover;
        background-position: center;
        width: 100%;
        padding: 5rem 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .service-banner h1 {
        font-size: 3rem;
        font-weight: 700;
        color: var(--color-purple);
        margin: 0;
    }

    .service-container {
        display: flex; 
        flex-wrap: wrap; 
        justify-content: center; 
        padding: 4rem 2rem; 
        gap: 2.5rem; 
        max-width: 1200px;
        margin: 0 auto; 
    }

    .service-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(102, 0, 85, 0.1); 
        
        flex-basis: 350px; 
        min-width: 300px; 
        max-width: 45%; 
        
        padding: 1.5rem;
        text-align: center;
        position: relative; 
        margin-top: 50px; 
    }

    .card-icon {
        width: 100px;
        height: 100px;
        background-color: var(--color-icon-bg);
        border-radius: 50%; 
        
        position: absolute;
        top: -50px; 
        left: 50%; 
        transform: translateX(-50%); 
        
        display: flex;
        justify-content: center;
        align-items: center;
        
        font-size: 2.5rem;
        color: var(--color-purple);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }

    .card-content {
        margin-top: 50px; 
    }

    .card-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--color-purple);
        margin: 0.5rem 0;
    }

    .card-content p {
        font-size: 1rem;
        color: var(--color-text-dark);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .card-link {
        font-size: 1rem;
        font-weight: 600;
        color: var(--color-purple);
        text-decoration: none;
        transition: letter-spacing 0.3s ease;
    }

    .card-link:hover {
        letter-spacing: 0.5px; 
    }

</style>
<section class="service-banner">
    <div class="banner-content">
        <h1>Our Service</h1>
    </div>
</section>

<main class="service-container">

    <div class="service-card">
        <div class="card-icon">
            <span role="img" aria-label="T-shirt">👕</span> 
        </div>
        <div class="card-content">
            <h3>Daily Kiloan</h3>
            <a href="<?= base_url('pemesanan?layanan=Daily Kiloan') ?>" class="card-link">Pilih Layanan →</a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-icon">
            <span role="img" aria-label="Bolt">⚡️</span> 
        </div>
        <div class="card-content">
            <h3>Express Kiloan</h3>
            <p>Lorem ipsum dolor sit amet.</p>
            <a href="<?= base_url('pemesanan?layanan=Express Kiloan') ?>" class="card-link">Pilih Layanan →</a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-icon">
            <span role="img" aria-label="Basket">🧺</span>
        </div>
        <div class="card-content">
            <h3>Cuci Kering</h3>
            <p>Lorem ipsum dolor sit amet.</p>
            <a href="<?= base_url('pemesanan?layanan=Cuci Kering') ?>" class="card-link">Pilih Layanan →</a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-icon">
            <span role="img" aria-label="Ironing">👔</span>
        </div>
        <div class="card-content">
            <h3>Setrika Saja</h3>
            <p>Lorem ipsum dolor sit amet.</p>
            <a href="<?= base_url('pemesanan?layanan=Setrika Saja') ?>" class="card-link">Pilih Layanan →</a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-icon">
            <span role="img" aria-label="Cycle">🔄</span>
        </div>
        <div class="card-content">
            <h3>Cuci & Setrika</h3>
            <p>Lorem ipsum dolor sit amet.</p>
            <a href="<?= base_url('pemesanan?layanan=Cuci dan Setrika') ?>" class="card-link">Pilih Layanan →</a>
        </div>
    </div>

</main>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>