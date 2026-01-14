<?php
class CommandeController extends Controller {
    private $commandeManager;

    public function __construct() {
        AuthMiddleware::handle();
        $this->commandeManager = $this->model('CommandeManager');
    }

    public function creer($packId) {
        // 1. Vérifier l'heure limite (Page 32 : Si > 16h00, rejet)
        if (date('H:i') > ORDER_DEADLINE) {
            Session::flash('order_err', 'Commandes fermées pour demain (limite 16h00)');
            redirect('client/menu');
            return;
        }

        // 2. Récupérer les infos du pack
        $pack = $this->model('PackManager')->getById($packId);
        
        // 3. Créer la commande en statut 'ATTENTE_PAIEMENT'
        $orderId = $this->commandeManager->create(Session::get('user_id'), $packId, $pack['prix']);

        if ($orderId) {
            redirect('commande/paiement/' . $orderId);
        }
    }
}