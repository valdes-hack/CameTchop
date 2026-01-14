<?php
class Controller {
    // Charger un modèle
    public function model($model) {
        require_once APPROOT . '/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Utilise la classe View pour afficher la page
     */
    public function view($view, $data = [], $layout = 'default') {
        View::render($view, $data, $layout);
    }
}