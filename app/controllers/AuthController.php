<?php
class AuthController extends Controller {
    private $userManager;

    public function __construct() {
        $this->userManager = $this->model('UserManager');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $phone = h($_POST['telephone']);
            $user = $this->userManager->findByPhone($phone);

            if ($user) {
                // Création de la session (simplifié sans password pour ce projet informel)
                Session::set('user_id', $user['id']);
                Session::set('user_name', $user['nom_complet']);
                Session::set('user_role', $user['role']);

                $user['role'] === 'ADMIN' ? redirect('admin/dashboard') : redirect('client/menu');
            } else {
                $this->view('auth/login', ['error' => 'Numéro inconnu']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        Session::delete('user_id');
        Session::delete('user_role');
        redirect('login');
    }
}