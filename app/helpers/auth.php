<?php
// Vérifie si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Vérifie si l'utilisateur a un rôle spécifique
function hasRole($role) {
    return (isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role);
}

// Redirection si non autorisé (pour les pages Admin)
function adminOnly() {
    if (!isLoggedIn() || !hasRole('ADMIN')) {
        header('Location: ' . URLROOT . '/login');
        exit();
    }
}

// Redirection simple
function redirect($page) {
    header('Location: ' . URLROOT . '/' . $page);
    exit();
}