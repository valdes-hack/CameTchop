<?php
// Chemins d'accès
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/cametchop');
define('SITENAME', 'CameTchop');

// Configuration des Packs (Basé sur la page 17 de ton document)
define('PACK_ECO_PRICE', 1500);
define('PACK_STANDARD_PRICE', 2000);
define('PACK_PREMIUM_PRICE', 2500);

// Heure limite de commande (Basé sur ton diagramme de séquence page 32)
define('ORDER_DEADLINE', '16:00');

// Paramètres de session
define('SESSION_NAME', 'cametchop_user_session');