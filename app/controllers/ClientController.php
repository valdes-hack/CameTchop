<?php
class ClientController extends Controller {
    private $packManager;
    private $menuManager;

    public function __construct() {
        AuthMiddleware::handle(); // Sécurise l'accès
        $this->packManager = $this->model('PackManager');
        $this->menuManager = $this->model('MenuManager');
    }

    public function menu() {
        $menu = $this->menuManager->getTodayMenu();
        $packs = $this->packManager->getAvailablePacks();

        $data = [
            'title' => 'Menu du jour',
            'menu' => $menu,
            'packs' => $packs
        ];

        $this->view('client/menu', $data);
    }

    public function wallet() {
        $user = $this->model('UserManager')->getById(Session::get('user_id'));
        $this->view('client/wallet', ['user' => $user]);
    }
}