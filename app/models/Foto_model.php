<?php
class Foto_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Call this in Ekspedisi controllers, primarily when in the view foreach loop it's called from the Ekspedisi Controller (not from Foto Controller), this can be called to make more easy (eventhough we can call this method with query same as from the ekspedisi model)
    public function getFotoEkspedisiById($idEkspedisi) {
        $query = "SELECT * FROM ekspedisi WHERE idEkspedisi = :idEkspedisi";
        $this->db->query($query);
        $this->db->bind(":idEkspedisi", $idEkspedisi);

        // Pastikan return single record
        return $this->db->single();
    }
}