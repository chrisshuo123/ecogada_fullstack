<div class="container margin-top-body">
    <h1>Data Layanan Ekspedisi</h1>

    <div class="card-styling" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 5%;">
    <?php if (!empty($data['ekspedisiGrouped'])) : ?>
        <?php foreach ($data['ekspedisiGrouped'] as $ekspedisiData) : ?>
            <div class="card">
                <div class="card-body" style="display: flex; flex-direction: column; height: 100%;">
                    <!-- Image dari Image controller -->
                    <div>
                        <img src="<?= BASEURL; ?>/foto/getImageEkspedisi/<?= $ekspedisiData['idEkspedisi']; ?>" alt="Foto Ekspedisi" class="image-ekspedisi">
                    </div>
                    <!-- Title -->
                    <div style="margin: 6% 0;">
                        <h5 class="card-title"><?= $ekspedisiData['namaEkspedisi'] ?></h5>
                    </div>
                    <!-- Services -->
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; flex-grow: 1; align-content: flex-start;">
                    <?php foreach($ekspedisiData['jenisLayanan'] as $jenis) : ?>
                        <span class="service-badge">
                            <?= $jenis ?>
                        </span>
                    <?php endforeach; ?>
                    </div>
                    <!-- Button -->
                    <div style="margin-top: auto; padding-top: 15px;">
                        <a href="<?= BASEURL; ?>/ekspedisi/detail/<?= $ekspedisiData['idEkspedisi']; ?>" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else : ?>
        <div class="no-data">Tidak ada data ekspedisi</div>
    <?php endif; ?>
</div>