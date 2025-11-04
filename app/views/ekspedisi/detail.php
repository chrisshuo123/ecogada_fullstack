<div class="container">
    <h1>Detail Ekspedisi <?= $data['judul_ekspedisi']; ?></h1>

    <?php if(!empty($data['jenisEkspedisi'])) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis Ekspedisi</th>
                    <th scope="col">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $rowCount = 1; ?>
                <?php foreach($data['jenisEkspedisi'] as $layanan) : ?>
                <tr>
                    <th scope="row"><?= $rowCount++; ?></th>
                    <td><strong><?= $layanan['jenisEkspedisi']; ?></strong></td>
                    <td><?= !empty($layanan['deskripsi']) ? $layanan['deskripsi'] : '<em class="text-muted">Tidak ada deskripsi</em>'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="<?= BASEURL; ?>/ekspedisi" class="btn btn-secondary">
                ← Kembali ke Daftar Ekspedisi
            </a>
        </div>

    <?php else : ?>
        <div class="alert alert-warning">
            <h4>Data tidak ditemukan</h4>
            <p>Tidak ada layanan yang tersedia untuk ekspedisi ini.</p>
            <a href="<?= BASEURL; ?>/ekspedisi" class="btn btn-secondary">
                ← Kembali ke Daftar Ekspedisi
            </a>
        </div>
    <?php endif; ?>
</div>