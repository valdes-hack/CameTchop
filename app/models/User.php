<?php
class User extends Model {
    public $id;
    public $nomComplet;
    public $telephone;
    public $email;
    public $role; // CLIENT, ADMIN, SUPER_ADMIN
    public $soldeWallet;
    public $dateInscription;
    public $actif;

    // Constantes pour éviter les erreurs de frappe
    const ROLE_CLIENT = 'CLIENT';
    const ROLE_ADMIN = 'ADMIN';
}