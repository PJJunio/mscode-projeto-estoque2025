<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\Model\User;

class LoginController extends AbstractController
{
    public function index(array $requestData): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $requestData['email'] ?? '';
            $password = $requestData['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';
            } else {
                $model = new User();
                $user = $model->getUserByEmail($email);

                if ($user && $model->checkPassword($password, $user['senha'])) {
                    session_start();
                    $_SESSION['user'] = $user['nome'];
                    $this->redirect('/');
                    return;
                } else {
                    $error = '<div class="alert alert-danger" role="alert">Email ou senha incorretos</div>';
                }
            }
        }
        $this->render('auth/login.php', ['error' => $error]);
    }
}
