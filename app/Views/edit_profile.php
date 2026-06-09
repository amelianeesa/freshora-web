<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<div class="profile-page-wrapper">

    <div style="max-width: 900px; margin: 0 auto; position: relative;">
        <a href="<?= base_url('account') ?>" class="btn-back-dashboard-integrated">
            <i class="fas fa-arrow-left"></i> Kembali Ke Akun
        </a>
    </div>

    <div class="profile-container">
        <h2 class="profile-title">Edit Your Profile</h2>

        <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" class="profile-form">
            
            <input type="hidden" name="gambarLama" value="<?= $user['profile_image'] ?>">

            <div class="profile-content">
                
                <div class="profile-left">
                    <div class="image-preview">
                        <img src="<?= base_url('uploads/profile/' . ($user['profile_image'] ? $user['profile_image'] : 'default.png')) ?>" alt="Profile" id="imgPreview">
                    </div>
                    
                    <div class="profile-actions">
                        <label for="profile_image" class="btn-change-profile">
                            <i class="fas fa-camera"></i> Ganti Foto
                        </label>
                        <input type="file" id="profile_image" name="profile_image" style="display: none;" onchange="previewImage()">
                    </div>
                </div>

                <div class="profile-right">
                    
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="fullname" value="<?= $user['fullname'] ?>" class="input-rounded" placeholder="Nama Lengkap Anda">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?= $user['username'] ?>" class="input-rounded" readonly style="background-color: #eee; cursor: not-allowed;" title="Username tidak bisa diganti sembarangan">
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text" name="phone" value="<?= $user['phone'] ?>" class="input-rounded" placeholder="0812...">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" class="input-rounded" rows="3" placeholder="Alamat Lengkap..."><?= $user['address'] ?></textarea>
                    </div>

                    <button type="submit" class="btn-save-change">Simpan Perubahan</button>

                </div>
            </div>
        </form>
    </div>

</div>

<script>
    function previewImage() {
        const image = document.querySelector('#profile_image');
        const imgPreview = document.querySelector('#imgPreview');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>