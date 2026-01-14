<?php
class UserManager extends Model {

    // Trouver un utilisateur par son téléphone (pour le login)
    public function findByPhone($phone) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE telephone = :phone");
        $stmt->execute(['phone' => $phone]);
        return $stmt->fetch();
    }

    // Enregistrer un nouvel étudiant (Page 28)
    public function register($data) {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (nom_complet, telephone, role, solde_wallet) VALUES (:nom, :phone, 'CLIENT', 0)");
        return $stmt->execute([
            'nom' => $data['nom'],
            'phone' => $data['phone']
        ]);
    }

    // Mettre à jour le solde (après paiement ou recharge)
    public function updateWallet($userId, $amount) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET solde_wallet = solde_wallet + :amount WHERE id = :id");
        return $stmt->execute(['amount' => $amount, 'id' => $userId]);
    }
}