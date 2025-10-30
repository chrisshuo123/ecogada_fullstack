<div class="container margin-top-body">
    <h1>User List Page</h1>
    <p>Halo, nama saya <?= $data['namaDepan']; ?> <?= $data['namaBelakang']; ?> dengan username <?= $data['username']; ?>.  Saya memiliki password <?= $data['password']; ?> saya adalah seorang admin inti dari Ecogada Fullstack</p>
    <div class="row">
        <div class="col-6">
            <h3>Daftar Mahasiswa</h3>
            <?php foreach($data['user'] as $user): ?>
                <ul>
                    <li><?= $user['tglRegistrasi']; ?></li>
                    <li><?= $user['namaDepan']; ?></li>
                    <li><?= $user['namaBelakang']; ?></li>
                    <li><?= $user['email']; ?></li>
                    <li><?= $user['username']; ?></li>
                    <li><?= $user['password']; ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>
