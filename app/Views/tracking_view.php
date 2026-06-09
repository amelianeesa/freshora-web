<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshora | Lacak Status Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --purple: #6B1A5A;
            --cream: #F9F1E7;
            --cream-card: #FDF8F0;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        body::before {
            content: ''; position: fixed; top:0; left:0; right:0; bottom:0;
            background: url('<?= base_url('img/buble.jpg') ?>') center/cover no-repeat;
            opacity: 0.75; z-index: -2;
        }
        body::after {
            content: ''; position: fixed; top:0; left:0; right:0; bottom:0;
            background: linear-gradient(135deg, rgba(249,241,231,0.95), rgba(155,75,140,0.1));
            z-index: -1;
        }
        main { flex:1; display:flex; align-items:center; justify-content:center; padding:40px 20px; }

        .card, .result-card {
            background: white;
            border-radius: 25px;
            padding: 40px;
            width: 100%;
            max-width: 520px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(107,26,90,0.15);
        }
        .result-card { max-width: 600px; background: var(--cream-card); }

        h1 { font-size:2.5rem; color:var(--purple); margin-bottom:10px; }
        .subtitle { color:#777; margin-bottom:30px; }

        .custom-input {
            width:100%; padding:16px 20px; border:2px solid #e0d4f0; border-radius:12px;
            font-size:1.1rem; background:#fdf9ff; margin-bottom:15px;
        }
        .custom-input:focus { outline:none; border-color:var(--purple); box-shadow:0 0 0 5px rgba(107,26,90,.1); }

        .btn-lacak {
            width:100%; padding:16px; background:var(--purple); color:white;
            border:none; border-radius:12px; font-size:1.2rem; font-weight:600; cursor:pointer;
        }
        .btn-lacak:hover { background:#4e1444; transform:translateY(-3px); }

        .order-number { font-size:1.8rem; font-weight:700; color:var(--purple); }
        .service-type { color:#666; margin:10px 0 30px; }

        /* PROGRESS BAR */
        .progress-container {
            display:flex; justify-content:space-between; align-items:center;
            position:relative; margin:50px 0;
        }
        .progress-bar {
            position:absolute; top:50%; left:10%; right:10%; height:6px;
            background:#e0d4f0; border-radius:3px; transform:translateY(-50%);
        }
        .progress-fill {
            height:100%; background:var(--purple); border-radius:3px;
            width: <?= $hasil_tracking['progress'] ?? 0 ?>%;
            transition: width 0.8s ease;
        }
        .step {
            background:white; width:60px; height:60px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            font-size:1.8rem; color:#ccc; border:5px solid #e0d4f0; z-index:1;
        }
        .step.active {
            color:var(--purple); border-color:var(--purple);
            box-shadow:0 0 0 8px rgba(107,26,90,0.15);
        }
        .step-label { margin-top:12px; font-size:0.95rem; color:#666; }
        .step.active .step-label { color:var(--purple); font-weight:600; }

        .error { background:#e74c3c; color:white; padding:15px; border-radius:12px; margin:20px 0; }
        .back-link { color:var(--purple); font-weight:600; text-decoration:none; font-size:1.1rem; }
    </style>
</head>
<body>

    <?= $this->include('layout/header') ?>

    <main>

        <?php if (!isset($hasil_tracking)): ?>
            <div class="card">
                <h1>Lacak Status Pesanan</h1>
                <p class="subtitle">Masukkan nomor pesanan kamu untuk melihat progres laundry</p>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="error"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('tracking/proses') ?>" method="post">
                    <input type="text" name="no_pesanan" class="custom-input" placeholder="Contoh: ABC12345" required>
                    <button type="submit" class="btn-lacak">Lacak Sekarang</button>
                </form>
            </div>

        <?php else: ?>
            <div class="result-card">
                <div class="order-number">ORDER #<?= esc($hasil_tracking['nomor']) ?></div>
                <div class="service-type">Jenis Layanan: <?= esc($hasil_tracking['layanan']) ?></div>

                <div class="progress-container">
                    <div class="progress-bar"><div class="progress-fill"></div></div>
                    <div class="step active"><i class="fas fa-truck-loading"></i></div>
                    <div class="step <?= $hasil_tracking['progress'] >= 66 ? 'active' : '' ?>"><i class="fas fa-soap"></i></div>
                    <div class="step <?= $hasil_tracking['progress'] >= 100 ? 'active' : '' ?>"><i class="fas fa-check-circle"></i></div>
                </div>

                <div style="display:flex; justify-content:space-between;">
                    <div class="step-label active">Pesanan Diterima</div>
                    <div class="step-label <?= $hasil_tracking['progress'] >= 66 ? 'active' : '' ?>">Sedang Dicuci</div>
                    <div class="step-label <?= $hasil_tracking['progress'] >= 100 ? 'active' : '' ?>">Selesai</div>
                </div>

                <div style="margin-top:40px; text-align:center;">
                    <a href="<?= base_url('tracking') ?>" class="back-link">← Lacak Pesanan Lain</a>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <?= $this->include('layout/footer') ?>
</body>
</html>