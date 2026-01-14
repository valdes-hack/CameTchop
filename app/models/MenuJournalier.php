<?php
class MenuJournalier extends Model {
    public $id;
    public $date;
    public $heureLimite; // Souvent 16h00 pour le lendemain
    public $estOuvert; // Boolean
}