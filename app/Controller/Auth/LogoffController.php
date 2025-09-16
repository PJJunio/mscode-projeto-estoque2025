<?php
namespace App\Controller\Auth;

use App\Controller\AbstractController;

class LogoffController extends AbstractController
{
    public function index(array $requestData): void
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /login');
    }
}