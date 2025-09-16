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

        var_dump($requestData['email']);

        $model = new User();

        $email = $model->getEmail($requestData['email']);

        $this->render('auth/login.php');
    }
}
