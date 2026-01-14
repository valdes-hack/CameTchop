<?php
class Paiement extends Model {
    public $id;
    public $commande_id;
    public $reference_operateur; // Le code reçu par SMS
    public $methode; // OM, MTN, WALLET
    public $montant;
    public $statut; // SUCCESS, FAILED, PENDING
    public $datePaiement;
}