<?php

class View {
    /**
     * Rend une vue avec des données
     * 
     * @param string $view Nom du fichier (ex: 'client/menu')
     * @param array $data Tableau associatif de données
     * @param string $layout Type de layout à utiliser ('default', 'admin', ou 'none')
     */
    public static function render($view, $data = [], $layout = 'default') {
        
        // On vérifie si le fichier de la vue existe
        $viewFile = APPROOT . '/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            // On extrait les données pour les rendre disponibles sous forme de variables
            // Ex: ['nom' => 'Kaham'] devient $nom = 'Kaham'
            extract($data);

            // Début de la mise en mémoire tampon
            ob_start();

            // Inclusion du header selon le layout
            if ($layout === 'admin') {
                require_once APPROOT . '/views/layouts/admin_header.php';
            } elseif ($layout === 'default') {
                require_once APPROOT . '/views/layouts/header.php';
            }

            // Inclusion de la vue principale
            require_once $viewFile;

            // Inclusion du footer
            if ($layout === 'admin') {
                require_once APPROOT . '/views/layouts/admin_footer.php';
            } elseif ($layout === 'default') {
                require_once APPROOT . '/views/layouts/footer.php';
            }

            // Envoi du contenu au navigateur
            echo ob_get_clean();
            
        } else {
            die("Erreur : La vue '{$view}' est introuvable dans " . APPROOT . "/views/");
        }
    }
}