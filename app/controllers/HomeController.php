<?php

class HomeController extends Controller {

    public function __construct() {
        // Pas de middleware ici car la page d'accueil est publique
    }

    public function index() {
        // Redirection intelligente si l'utilisateur est déjà connecté
        if (isLoggedIn()) {
            if (hasRole('ADMIN')) {
                redirect('admin/dashboard');
            } else {
                redirect('client/menu');
            }
        }

        // Si non connecté, on affiche la page de présentation
        $data = [
            'title' => 'Bienvenue sur CameTchop Digital',
            'description' => 'Votre service de restauration étudiante à Keyce Douala, désormais 100% digitalisé.'
        ];

        $this->view('home/index', $data);
    }
}