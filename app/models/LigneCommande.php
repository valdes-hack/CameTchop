<?php
class LigneCommande extends Model {
    public $id;
    public $commande_id;
    public $pack_id;
    public $quantite;
    public $prixUnitaire; // Prix au moment de l'achat
    public $notesSpeciales; // ex: "Sans piment"
}