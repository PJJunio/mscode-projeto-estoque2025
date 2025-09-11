<?php

use App\Controller\Auth\LoginController;

$loginController = new LoginController();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginController->login($email, $password);
}