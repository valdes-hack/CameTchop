<?php
class Router {
    protected $currentController = 'HomeController'; // Contrôleur par défaut
    protected $currentMethod = 'index';             // Méthode par défaut
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // 1. Chercher le contrôleur (ex: ClientController)
        if (isset($url[0]) && file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->currentController = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once APPROOT . '/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // 2. Chercher la méthode dans le contrôleur (ex: viewMenu)
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // 3. Récupérer les paramètres restants (ex: ID du pack)
        $this->params = $url ? array_values($url) : [];

        // 4. Appeler la méthode avec les paramètres
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}