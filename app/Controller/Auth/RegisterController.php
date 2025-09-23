<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\Model\User;

class RegisterController extends AbstractController
{
    public function index(array $requestData): void
    {
        $model = new User();

        $error = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['password']))
            {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';

            } elseif (strlen($_POST['password']) < 8) {
                $error = '<div class="alert alert-danger" role="alert">A senha deve ter no mínimo 8 caracteres!</div>';

            } elseif ($model->createUser($_POST['user'], $_POST['email'], $_POST['password'])) {
                header('Location: /login');
                exit;
            }
        }

        $this->render('auth/register.php', ['error' => $error]);
    }
}
