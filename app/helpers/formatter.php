<?php
// Formater un montant en FCFA
function formatMoney($amount) {
    return number_format($amount, 0, ',', ' ') . ' FCFA';
}

// Formater la date pour CameTchop (ex: "Mardi 15 Dec 2025")
function formatDate($date) {
    return date('D d M Y', strtotime($date));
}

// Générer une chaîne pour le QR Code (Basé sur l'ID commande)
function formatQrData($orderId, $userId) {
    return "CAMETCHOP-" . $orderId . "-" . $userId;
}

// Formater l'heure (ex: 12h30)
function formatTime($time) {
    return date('H\hi', strtotime($time));
}