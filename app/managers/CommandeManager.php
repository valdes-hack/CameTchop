<?php
class CommandeManager extends Model {

    // Créer une commande (Scénario Page 32)
    public function create($userId, $packId, $total) {
        try {
            $this->db->beginTransaction();

            $orderId = bin2hex(random_bytes(16)); // Génère un UUID simplifié
            
            // 1. Insérer la commande
            $stmt = $this->db->prepare("INSERT INTO commandes (id, utilisateur_id, montant_total, statut, date_livraison_prevue) 
                                      VALUES (:id, :u_id, :total, 'ATTENTE_PAIEMENT', DATE_ADD(NOW(), INTERVAL 1 DAY))");
            $stmt->execute([
                'id' => $orderId,
                'u_id' => $userId,
                'total' => $total
            ]);

            // 2. Créer la ligne de commande (LigneCommande)
            $stmtLine = $this->db->prepare("INSERT INTO ligne_commandes (commande_id, pack_id, quantite, prix_unitaire) VALUES (?, ?, 1, ?)");
            $stmtLine->execute([$orderId, $packId, $total]);

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // Mettre à jour le statut (ex: passer à 'CONFIRMEE' après paiement)
    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE commandes SET statut = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    // Récupérer les commandes du jour pour la gérante (Page 18)
    public function getDailyOrders() {
        $stmt = $this->db->prepare("SELECT c.*, u.nom_complet 
                                   FROM commandes c 
                                   JOIN utilisateurs u ON c.utilisateur_id = u.id 
                                   WHERE DATE(c.date_creation) = CURDATE()");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}