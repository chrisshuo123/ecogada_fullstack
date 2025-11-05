<?php
class Image extends Controller {
    // Untuk Image ekspedisi
    public function ekspedisi($idEkspedisi) {
        $model = $this->model('Ekspedisi_model');
        $data = $model->getEkspedisiById($idEkspedisi);
        $this->outputImage($data['fotoEkspedisi']);
    }

    // Konfigurasi buat menampilkan image
    private function outputImage($blobData) {
        if($blobData) {
            $imageType = $this->detectImageType($blobData);
            header('Content-Type: ' . $imageType);
            echo $blobData;
        } else {
            $this->showDefaultImage();
        }
        exit;
    }

    private function detectImageType($imageData) {
        // ... detection logic ...
        if(empty($imageData)) return 'image/png';

        $header = substr($imageData, 0, 4);

        if(strpos($header, "\x89PNG") === 0) {
            return 'image/png';
        } elseif(strpos($header, "\xFF\xD8") === 0) {
            return 'image/jpeg';
        } elseif(strpos($header, "GIF8") === 0) {
            return 'image/gif';
        } else {
            return 'image/jpg';
        }
    }

    private function showDefaultImage() {
        // ... default image logic ...
        header('Content-Type: image/png');
        $img = imagecreate(200, 150);
        $bg = imagecolorallocate($img, 240, 240, 240);
        $textColor = imagecolorallocate($img, 150, 150, 150);
        imagestring($img, 3, 40, 65, 'Image Not Found', $textColor);
        imagepng($img);
        imagedestroy($img);
    }
}
?>