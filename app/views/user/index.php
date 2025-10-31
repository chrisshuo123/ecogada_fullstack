<div class="container margin-top-body">
    <h1>User List Page</h1>
    <p>Halo, nama saya <?= $data['namaDepan']; ?> <?= $data['namaBelakang']; ?> dengan username <?= $data['username']; ?>.  Saya memiliki password <?= $data['password']; ?> saya adalah seorang admin inti dari Ecogada Fullstack</p>
    <h2>List User Merchant EcoGada Goods</h2>
    <button type="button" class="btn btn-primary" style="margin: 1.5% 0 1.5% 0;" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah User Merchant
    </button>
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
                        <a href="<?= BASEURL; ?>/user/detail/<?= $user['idUser']; ?>"><span class="badge text-bg-primary">Detail</span></a>
                        <a><span class="badge text-bg-warning">Ubah</span></a>
                        <a><span class="badge text-bg-danger">Hapus</span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/user/tambah" method="POST">
                    <!-- Nama Depan -->
                    <div class="mb-3">
                        <label for="namaDepan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="namaDepan" name="namaDepan" placeholder="Input Nama Depan">
                    </div>
                    <!-- Nama Belakang -->
                    <div class="mb-3">
                        <label for="namaBelakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="namaBelakang" name="namaBelakang" placeholder="Input Nama Belakang">
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Email lalu @ domain email anda">
                    </div>
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Username">
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Input Password">
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

