<div class="container margin-top-body" id="ekspedisi-container"
    data-ekspedisi-nama="<?= htmlspecialchars($data['judul_ekspedisi']) ?>"
    data-ekspedisi-id="<?= $data['idEkspedisi'] ?>">

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

    <div class="tambah-layanan-ekspedisi tombolTambahDataJenisEkspedisi"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">Tambah List Layanan Ekspedisi</a></div>

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
                <?php foreach($data['jenisEkspedisi'] as $je) : ?>
                <tr>
                    <th scope="row"><?= $rowCount++; ?></th>
                    <td><strong><?= $je['jenisEkspedisi']; ?></strong></td>
                    <td><?= !empty($je['deskripsi']) ? $je['deskripsi'] : '<em class="text-muted">Tidak ada deskripsi</em>'; ?></td>
                    <td class="jenis-ekspedisi-button">
                        <div>
                            <a href="#" type="button" class="btn btn-warning tombolUbahDataJenisEkspedisi"
                                data-bs-toggle="modal"
                                data-bs-target="#formModal"
                                data-id="<?= $je['idJenisEkspedisi']; ?>"
                                data-jenis-ekspedisi="<?= htmlspecialchars($je['jenisEkspedisi']) ?>"
                                data-deskripsi="<?= htmlspecialchars($je['deskripsi']); ?>">
                                
                                Ubah
                            </a>

                            <!-- <a href="BASEURL/ekspedisi/getPindahJenisEkspedisi/$je['idJenisEkspedisi'];" type="button" class="btn btn-primary tombolPindahDataJenisEkspedisi" data-bs-toggle="modal" data-bs-target="#formModal" id-pindahekspedisi="$je['idJenisEkspedisi'];">
                                Pindah
                            </a> -->

                            <a href="#" type="button" class="btn btn-primary tombolPindahDataJenisEkspedisi"
                                data-bs-toggle="modal"
                                data-bs-target="#formModal"
                                data-id="<?= $je['idJenisEkspedisi']; ?>"
                                data-jenis-ekspedisi="<?= htmlspecialchars($je['jenisEkspedisi']); ?>">
                                
                                Pindah
                            </a>

                            <a type="button" class="btn btn-danger" 
                                href="<?= BASEURL ?>/ekspedisi/hapusJenisEkspedisi/<?= $je['idJenisEkspedisi'] ?>/<?= $data['idEkspedisi'] ?>" onclick="return confirm('Yakin mau hapus baris No <?= $rowCount-1 ?> ini?')">
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
    console.log('PHP idEkspedisi:', '<?= $data['idEkspedisi'] ?>');
    </script>
</div>

<!-- MODAL POP-UP -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="judulModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModalLabel">Tambah Jenis Layanan <?= $data['judul_ekspedisi']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form method="POST" action="<?= BASEURL; ?>/ekspedisi/tambahJenisEkspedisi" id="formPindahEkspedisi"> -->
                <form method="POST" id="formModalEkspedisi" action="#"> <!-- << formModalEkspedisi -->
                    <!-- Critical Hidden field IDs -->
                    <input type="hidden" name="idJenisEkspedisi" id="idJenisEkspedisi" value="">
                    <input type="hidden" name="idEkspedisi" id="idEkspedisiModal" value="<?= $data['idEkspedisi']; ?>">

                    <!-- Jenis Ekspedisi -->
                    <div class="mb-3">
                        <label for="jenisEkspedisi" class="form-label" id="labelJenisEkspedisi">Jenis Ekspedisi</label>
                        <input type="text" class="form-control" id="jenisEkspedisi" name="jenisEkspedisi" placeholder="Input Jenis Layanan dari <?= $data['judul_ekspedisi']; ?>"> <!-- id="jenisEkspedisiModal" commented -->
                    </div>
                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label" id="labelDeskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Input Deskripsi layanan dari <?= $data['judul_ekspedisi']; ?>"></textarea>
                    </div> <!-- id="deskripsiModal" commented -->
                    
                    <!-- Pindah Ekspedisi (Dropdown) -->
                    <div class="mb-3" id="panelDropdownEkspedisi" style="display: none;">
                        <label for="comboboxSelect" class="form-label">Pindah ke Ekspedisi: </label>
                        <div class="combobox-container">
                            <!-- <input type="text" id="comboboxInput" placeholder="Select or type..."> -->
                            <select class="form-select" id="comboboxSelect" name="idEkspedisiBaru"> <!-- id="idEKspedisi" dihapus -->
                            <!-- <select class="form-control" id="pindahEkspedisi" name="idEkspedisi"> -->
                                <?php foreach ($data['all_ekspedisi'] as $eks): ?>
                                    <option value="<?= $eks['idEkspedisi']; ?>" <?= $eks['idEkspedisi'] == $data['idEkspedisi'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($eks['namaEkspedisi']); ?>
                                    </option>
                                <?php endforeach; ?>
                                <!-- <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option> -->
                            </select>
                        </div>
                    </div>
                    <!-- tglInput (hidden) -->
                    <input type="hidden" name="tglInput" value="<?= date('Y-m-d H:i:s') ?>">
                    <!-- idEkspedisi untuk redirect -->
                    <!-- <input type="hidden" name="idEkspedisi" value=" $data['idEkspedisi']; "> -->
                                
                    <!-- Tambahkan field yang dibutuhkan model -->
                    <!-- <input type="hidden" name="idEkspedisi_fkLayananEkspedisi" id="idEkspedisi_fkLayananEkspedisi" value=" $data['idEkspedisi'] ">
                    <input type="hidden" name="idLayananEkspedisi" id="idLayananEkspedisi" value="">
                    <input type="hidden" id="idEkspedisi" name="idEkspedisi_hidden" value=""> -->
                <!-- </form> -->
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="tombolData">Tambah</button> <!-- btn btn-primary, btn-danger, btn-warning dipanggil via JQuery -->
                </form>
            </div>
        </div>
    </div>
</div>