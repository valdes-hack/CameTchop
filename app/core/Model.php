<?php
abstract class Model {
    protected $db;

    public function __construct() {
        // On récupère l'instance PDO unique
        $this->db = Database::getConnection();
    }
}