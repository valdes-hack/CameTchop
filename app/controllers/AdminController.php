<?php
class AdminController extends Controller {
    private $commandeManager;
    private $stockManager;

    public function __construct() {
        AdminMiddleware::handle(); // Seule la gérante accède ici
        $this->commandeManager = $this->model('CommandeManager');
        $this->stockManager = $this->model('StockManager');
    }

    public function dashboard() {
        $orders = $this->commandeManager->getDailyOrders();
        $alerts = $this->stockManager->checkStockAlerts();

        $data = [
            'orders' => $orders,
            'alerts' => $alerts,
            'total_ca' => array_sum(array_column($orders, 'montant_total'))
        ];

        $this->view('admin/dashboard', $data, 'admin'); // Utilise le layout admin
    }
}