<div class="container margin-top-body" id="ekspedisi-container" data-ekspedisi-nama="<?= htmlspecialchars($data['judul_ekspedisi']) ?>">

    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <h1>Detail Ekspedisi <?= $data['judul_ekspedisi']; ?></h1>

    <?php if(isset($data['fotoBase64'])): ?>
        <img src="<?= $data['fotoBase64']; ?>"
            alt="Foto Ekspedisi"
            <?= $data['judul_ekspedisi']; ?>
            class="foto-detail-ekspedisi">
    <?php else: ?>
        <img src="<?= BASEURL; ?>/img/default-ekspedisi.png"
            alt="Foto Default"
            class="foto-detail-ekspedisi">
    <?php endif; ?>

    <div class="tambah-layanan-ekspedisi tombolTambahDataJenisEkspedisi"><a href="<?= BASEURL; ?>/ekspedisi/detail/tambah" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">Tambah List Layanan Ekspedisi</a></div>

    <?php if(!empty($data['jenisEkspedisi'])) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="col-sm-1">#</th>
                    <th scope="col" class="col-sm-2">Jenis Ekspedisi</th>
                    <th scope="col" class="col-sm-4">Deskripsi</th>
                    <th scope="col" class="col-sm-2">CRUD Editor</th>
                </tr>
            </thead>
            <tbody>
                <?php $rowCount = 1; ?>
                <?php foreach($data['jenisEkspedisi'] as $layanan) : ?>
                <tr>
                    <th scope="row"><?= $rowCount++; ?></th>
                    <td><strong><?= $layanan['jenisEkspedisi']; ?></strong></td>
                    <td><?= !empty($layanan['deskripsi']) ? $layanan['deskripsi'] : '<em class="text-muted">Tidak ada deskripsi</em>'; ?></td>
                    <td class="jenis-ekspedisi-button">
                        <div>
                            <a type="button" class="btn btn-warning tombolUbahDataJenisEkspedisi" data-bs-toggle="modal" data-bs-target="#formModal">Ubah</a>
                            <a type="button" class="btn btn-danger" 
                            href="<?= BASEURL ?>/ekspedisi/hapusJenisEkspedisi/<?= $layanan['idJenisEkspedisi'] ?>/<?= $data['idEkspedisi'] ?>" onclick="return confirm('Yakin mau hapus baris No <?= $rowCount-1 ?> ini?')">
                            Hapus
                            </a>
                        </div>
                    </td>
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

    <!-- Debug output -->
    <script>
    console.log('PHP judul_ekspedisi:', '<?= $data['judul_ekspedisi'] ?>');
    </script>
</div>

<!-- MODAL POP-UP -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="judulModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModalLabel">Tambah Jenis Layanan JNE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/ekspedisi/tambahJenisEkspedisi" method="POST">
                    <input type="hidden" name="idEkspedisi" id="idEkspedisi" value="<?= $data['idEkspedisi'] ?>">
                    <!-- Jenis Ekspedisi -->
                    <div class="mb-3">
                        <label for="jenisEkspedisi" class="form-label">Jenis Ekspedisi</label>
                        <input type="text" class="form-control" id="jenisEkspedisi" name="jenisEkspedisi" placeholder="Input Jenis Layanan dari JNE"> <!-- id="jenisEkspedisiModal" commented -->
                    </div>
                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Input Deskripsi layanan dari JNE"></textarea>
                    </div> <!-- id="deskripsiModal" commented -->
                    <!-- tglInput (hidden) -->
                    <input type="hidden" name="tglInput" value="<?= date('Y-m-d H:i:s') ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="tombolData">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>