<?php
class Pack extends Model {
    public $id;
    public $nom;
    public $description;
    public $prix;
    public $imageUrl;
    public $disponible;
    public $stockJour;

    // Règles métier (page 29) : le prix doit être multiple de 50
    public function isValidPrice() {
        return ($this->prix >= 1000 && $this->prix % 50 === 0);
    }
}