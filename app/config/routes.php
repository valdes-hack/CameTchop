<?php
/**
 * Structure : 'url' => 'Controleur/Methode'
 */
$routes = [
    // Public
    '' => 'HomeController/index',
    'login' => 'AuthController/login',
    'register' => 'AuthController/register',
    'logout' => 'AuthController/logout',

    // Client (Étudiant)
    'menu' => 'ClientController/viewMenu',
    'commande/creer' => 'CommandeController/create',
    'commande/historique' => 'ClientController/history',
    'wallet' => 'ClientController/wallet',

    // Admin (Gérante)
    'admin/dashboard' => 'AdminController/index',
    'admin/commandes' => 'AdminController/manageOrders',
    'admin/stocks' => 'AdminController/manageStocks',
    'admin/packs' => 'PackController/index',

    // API (Pour les notifications Mobile Money et scan QR)
    'api/payment/callback' => 'ApiController/paymentCallback',
    'api/order/verify' => 'ApiController/verifyQR'
];

return $routes;