<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\Database\Query;
use App\Database\Database;
use App\Model\User;
use Throwable;

class LoginController extends AbstractController
{

    public function index(array $requestData): void
    {
        $model = new User();

        $email = $model->getEmail($requestData['email']);

        var_dump($email);

        $this->render('auth/login.php');
    }
}
