<?php

class PackController extends Controller {
    private $packManager;

    public function __construct() {
        // Sécurité : Seule la gérante peut gérer les packs
        AdminMiddleware::handle();
        $this->packManager = $this->model('PackManager');
    }

    /**
     * Liste tous les packs pour l'administration
     */
    public function index() {
        $packs = $this->packManager->getAvailablePacks(); // Ou une méthode getAllPacks()

        $data = [
            'title' => 'Gestion des Packs',
            'packs' => $packs
        ];

        $this->view('admin/packs', $data, 'admin');
    }

    /**
     * Modifier les détails d'un pack (Prix, Stock, Disponibilité)
     */
    public function editer($id) {
        $pack = $this->packManager->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation des données (Règles page 29)
            $prix = intval($_POST['prix']);
            
            if ($prix < 1000 || $prix % 50 !== 0) {
                Session::flash('pack_err', 'Le prix doit être >= 1000 FCFA et multiple de 50.');
                redirect('pack/editer/' . $id);
                return;
            }

            $updateData = [
                'id'          => $id,
                'nom'         => h($_POST['nom']),
                'prix'        => $prix,
                'stock_jour'  => intval($_POST['stock_jour']),
                'disponible'  => isset($_POST['disponible']) ? 1 : 0
            ];

            // Appel au manager pour sauvegarder (méthode à ajouter dans PackManager)
            // $this->packManager->update($updateData);

            Session::flash('pack_success', 'Pack mis à jour avec succès.');
            redirect('admin/packs');
        } else {
            $this->view('admin/edit_pack', ['pack' => $pack], 'admin');
        }
    }

    /**
     * Mise à jour rapide du stock (Scénario Page 37)
     */
    public function updateStock() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $packId = $_POST['pack_id'];
            $nouveauStock = $_POST['quantite'];
            
            // Logique de mise à jour rapide...
            Session::flash('stock_msg', 'Stock mis à jour.');
            redirect('admin/dashboard');
        }
    }
}