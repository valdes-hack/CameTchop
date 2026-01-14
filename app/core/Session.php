<?php
class Session {
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public static function delete($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Pour afficher un message de succès après une commande par exemple
    public static function flash($name, $message = '') {
        if (!empty($name)) {
            if (!empty($message)) {
                $_SESSION[$name] = $message;
            } elseif (isset($_SESSION[$name])) {
                $msg = $_SESSION[$name];
                unset($_SESSION[$name]);
                return $msg;
            }
        }
        return '';
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}