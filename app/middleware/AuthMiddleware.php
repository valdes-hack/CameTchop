<?php

class AuthMiddleware {
    /**
     * Empêche l'accès aux utilisateurs non connectés
     */
    public static function handle() {
        // On vérifie si la session user_id existe
        if (!isset($_SESSION['user_id'])) {
            // Utilisation du helper flash pour un message d'erreur
            Session::flash('auth_error', 'Veuillez vous connecter pour accéder à cette page.');
            
            // Redirection vers la page de connexion
            header('Location: ' . URLROOT . '/login');
            exit();
        }
    }

    /**
     * Empêche un utilisateur déjà connecté d'aller sur login/register
     */
    public static function redirectIfAuthenticated() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/home');
            exit();
        }
    }
}