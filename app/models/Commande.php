<?php
class Commande extends Model {
    public $id; // UUID
    public $user_id;
    public $dateCreation;
    public $statut;
    public $qrCode;
    public $montantTotal;
    public $dateLivraisonPrevue;

    // Statuts issus de ton diagramme (page 28)
    const STATUS_PANIER = 'PANIER';
    const STATUS_ATTENTE = 'ATTENTE_PAIEMENT';
    const STATUS_CONFIRMEE = 'CONFIRMEE';
    const STATUS_PREPARATION = 'EN_PREPARATION';
    const STATUS_PRETE = 'PRETE';
    const STATUS_LIVREE = 'LIVREE';
    const STATUS_ANNULEE = 'ANNULEE';
}