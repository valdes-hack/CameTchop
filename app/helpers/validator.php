<?php
// Valider le format téléphone camerounais (6XX XX XX XX)
function validatePhone($phone) {
    // Regex pour 9 chiffres commençant par 6
    return preg_match('/^6[256789][0-9]{7}$/', $phone);
}

// Vérifier si un champ est vide
function isEmpty($data) {
    return empty(trim($data));
}

// Valider la longueur d'une chaîne (ex: Nom 2-50 caractères)
function validateLength($data, $min, $max) {
    $len = strlen(trim($data));
    return ($len >= $min && $len <= $max);
}

// Valider un email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}