<div class="container margin-top-body">
    <h1>User List Page</h1>
    <p>Halo, nama saya <?= $data['namaDepan']; ?> <?= $data['namaBelakang']; ?> dengan username <?= $data['username']; ?>.  Saya memiliki password <?= $data['password']; ?> saya adalah seorang admin inti dari Ecogada Fullstack</p>
    <h2>List User Merchant EcoGada Goods</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal Registrasi</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th>Panel</th>
            </tr>
        </thead>
        <tbody>
            <?php $rowCount = 1; ?>
            <?php foreach($data['user'] as $user): ?>
                <tr>
                    <th scope="row"><?= $rowCount++ ?></th>
                    <td scope="col"><?= $user['tglRegistrasi']; ?></td>
                    <td scope="col"><?= $user['namaDepan']; ?> <?= $user['namaBelakang']; ?> </td>
                    <td scope="col"><?= $user['username']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-warning">Ubah</button>
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
