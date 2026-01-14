<?php
class StockManager extends Model {

    // Vérifier si un stock est bas (Page 38: CRITIQUE si stock < consommation_jour * 1)
    public function checkStockAlerts() {
        // Cette requête compare le stock actuel à un seuil (ici fixe pour l'exemple)
        $stmt = $this->db->prepare("SELECT nom, stock_jour FROM packs WHERE stock_jour < 10");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Décrémenter le stock lors d'une commande
    public function decrementStock($packId) {
        $stmt = $this->db->prepare("UPDATE packs SET stock_jour = stock_jour - 1 WHERE id = :id AND stock_jour > 0");
        return $stmt->execute(['id' => $packId]);
    }
}