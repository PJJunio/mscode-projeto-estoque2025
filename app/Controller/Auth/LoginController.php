<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\Model\User;

class LoginController extends AbstractController
{
    public function index(array $requestData): void
    {
        $error = null;

        if (!empty($requestData['email']) && !empty($requestData['password'])) {
            $model = new User();
            $user = $model->getUserByEmail($requestData['email']);

            if ($user && $requestData['password'] === $user['senha']) {
                session_start();
                $_SESSION['user'] = $user['nome'];
                $this->redirect('/');
                return;
            } else {
                $error = '<div class="alert alert-danger" role="alert">Email ou senha incorretos</div>';
            }
        }

        $this->render('auth/login.php', ['error' => $error]);
    }
}
