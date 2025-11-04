<div class="container mt-5">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h3 class="card-title" id="judulModalLabel">Detail <?= $data['user']['namaDepan']; ?> <?= $data['user']['namaBelakang']; ?></h3>
            <p class="card-text"><?= $data['user']['tglRegistrasi']; ?></p>
            <p class="card-text"><?= $data['user']['namaDepan']; ?></p>
            <p class="card-text"><?= $data['user']['namaBelakang']; ?></p>
            <p class="card-text"><?= $data['user']['email']; ?></p>
            <p class="card-text"><?= $data['user']['username']; ?></p>
            <p class="card-text"><?= $data['user']['password']; ?></p>
            <a href="<?= BASEURL; ?>/user" class="card-link">Kembali</a>
        </div>
    </div>
</div>