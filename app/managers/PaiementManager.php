<?php
class PaiementManager extends Model {

    // Enregistrer une tentative de paiement
    public function logTransaction($data) {
        $stmt = $this->db->prepare("INSERT INTO paiements (commande_id, reference_operateur, methode, montant, statut) 
                                  VALUES (:cmd_id, :ref, :methode, :montant, 'PENDING')");
        return $stmt->execute([
            'cmd_id'  => $data['commande_id'],
            'ref'     => $data['reference'],
            'methode' => $data['methode'],
            'montant' => $data['montant']
        ]);
    }

    // Confirmer un paiement après retour API (Page 34)
    public function confirmPayment($reference, $newStatus) {
        $stmt = $this->db->prepare("UPDATE paiements SET statut = :status, date_paiement = NOW() WHERE reference_operateur = :ref");
        return $stmt->execute([
            'status' => $newStatus,
            'ref'    => $reference
        ]);
    }

    // Vérifier si une commande est payée
    public function isOrderPaid($commandeId) {
        $stmt = $this->db->prepare("SELECT id FROM paiements WHERE commande_id = ? AND statut = 'SUCCESS'");
        $stmt->execute([$commandeId]);
        return $stmt->fetch() ? true : false;
    }
}