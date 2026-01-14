<?php

class AdminMiddleware {
    /**
     * Autorise uniquement l'administrateur (la gérante)
     */
    public static function handle() {
        // 1. On vérifie d'abord s'il est connecté
        AuthMiddleware::handle();

        // 2. On vérifie si son rôle est bien ADMIN
        // (Basé sur l'énumération de ton diagramme de classe page 28)
        if ($_SESSION['user_role'] !== 'ADMIN' && $_SESSION['user_role'] !== 'SUPER_ADMIN') {
            
            // Redirection vers une page d'erreur 403 (Interdit)
            header('Location: ' . URLROOT . '/errors/403');
            exit();
        }
    }
}