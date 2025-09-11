<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\Database\Query;
use App\Database\Database;
use Throwable;

class LoginController extends AbstractController
{
    private Query $query;

    public function __construct() {
        $this->query = new Query();
    }

    public function index(array $requestData): void
    {
        $this->render('auth/login.php');
    }

    public function login($email, $password)
    {
        try {
            if (empty($email) || empty($password)) {
                return [
                    'success' => false,
                    'message' => "Preencha todos os campos"
                ];
            }

            $userPassword = $this->query->getPassword($email, $password);

            if ($userPassword) {
                echo "teste deu bom";
            }
        } catch (\Throwable $th) {
            return [
                'sucess' => false,
                'message' => 'Deu ruim :('
            ];
        }
    }
}
