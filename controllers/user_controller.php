<?php

namespace controllers;

require "../models/user_model.php";

class user_controller {
    private $user_model;

    public function __construct() {
        $this->user_model = new \models\user_model();
    }

    public function register_user() {
        $this->user_model->register();
    }

    public function login_user() {
        $this->user_model->login();
    }

    public function logout_user() {
        $this->user_model->logout();
    }
}

session_start(); // Zajistí inicializaci session na začátku skriptu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new user_controller();
    $action = $_POST['action'];

    if ($action === 'register') {
        $controller->register_user();
    } elseif ($action === 'login') {
        $controller->login_user();
    } elseif ($action === 'logout') {
        $controller->logout_user();
    }
}
?>