<?php
class PackManager extends Model {

    // Récupérer les packs disponibles pour le menu du jour
    public function getAvailablePacks() {
        $stmt = $this->db->prepare("SELECT * FROM packs WHERE disponible = 1 AND stock_jour > 0");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer un pack par son ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM packs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}