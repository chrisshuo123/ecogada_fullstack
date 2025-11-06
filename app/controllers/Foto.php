<?php

class Foto extends Controller {

    public function index() {
        // Redirect atau tampilkan error
        header('HTTP/1.0 404 Not Found');
        echo "Page not found";
        exit;
    }

    // Ini khusus Debug, atau mereturn foreach view yang merupakan array grouped
    // terutama array group yg butuh pemanggilan luarnya array group tsb.
    public function getImageEkspedisi($idEkspedisi) {
        while(ob_get_level()) {
            ob_end_clean();
        }

        error_log("=== DEBUG getImageEkspedisi ===");
        error_log("ID Ekspedisi received: " . $idEkspedisi);

        $model = $this->model('Foto_model');
        $foto = $model->getFotoEkspedisiById($idEkspedisi);

        error_log("Foto data from model: " . print_r($foto, true));

        if($foto && !empty($foto['fotoEkspedisi'])) {
            error_log("Foto EXISTS, size: " . strlen($foto['fotoEkspedisi']));

            // Coba detect image type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($foto['fotoEkspedisi']);
            error_log("Detected MIME type: " . $mime_type);

            // Set header berdasarkan detected type
            header("Content-Type: " . $mime_type);
            header("Content-Length: " . strlen($foto['fotoEkspedisi']));
            echo $foto['fotoEkspedisi'];
        } else {
            error_log("Foto NOT FOUND or EMPTY, serving default image");
            // Return default image jika tidak ada
            $this->serveDefaultImage();
        }
        exit;
    }

    private function serveDefaultImage() {
        $defaultImagePath = file_get_contents(BASEURL . '/img/default-ekspedisi.jpg');
        if (file_exists($defaultImagePath)) {
            header("Content-Type: image/jpeg");
            header("Content-Length: " . filesize($defaultImagePath));
            readfile($defaultImagePath);
        } else {
            // Fallback: create simple image
            header("Content-Type: image/png");
            $img = imagecreate(100, 100);
            $bg = imagecolorallocate($img, 200, 200, 200);
            $text_color = imagecolorallocate($img, 0, 0, 0);
            imagestring($img, 5, 10, 45, "No Image", $text_color);
            imagepng($img);
            imagedestroy($img);
        }
    }
}