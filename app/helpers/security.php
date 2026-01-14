<?php
// Protection contre les failles XSS
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Génération d'un jeton CSRF pour les formulaires
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Vérification du jeton CSRF
function verify_csrf_token($token) {
    if (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']) {
        unset($_SESSION['csrf_token']); // Optionnel : renouveler après usage
        return true;
    }
    return false;
}