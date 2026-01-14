<?php
class WalletManager extends Model {

    // Débiter le compte pour un repas
    public function payWithWallet($userId, $amount) {
        try {
            $this->db->beginTransaction();

            // 1. Vérifier le solde actuel
            $stmt = $this->db->prepare("SELECT solde_wallet FROM utilisateurs WHERE id = ? FOR UPDATE");
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            if ($user['solde_wallet'] < $amount) {
                throw new Exception("Solde insuffisant");
            }

            // 2. Déduire le montant
            $stmtUpdate = $this->db->prepare("UPDATE utilisateurs SET solde_wallet = solde_wallet - :amount WHERE id = :id");
            $stmtUpdate->execute(['amount' => $amount, 'id' => $userId]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // Recharger le compte (Page 17)
    public function addFunds($userId, $amount) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET solde_wallet = solde_wallet + :amount WHERE id = :id");
        return $stmt->execute(['amount' => $amount, 'id' => $userId]);
    }
}