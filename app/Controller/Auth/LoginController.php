<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function index (array $requestData): void
    {
        $this->render('auth/login.php');
    }
}
