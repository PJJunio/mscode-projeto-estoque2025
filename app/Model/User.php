<?php

namespace App\Model;

use App\Database\Query;

class User
{
    private Query $conn;
    
    public function __construct()
    {
        $this->conn = new Query();
    }

    public function getEmail($email)
    {
        $result = $this->conn->count("usuario", "email = ?", [$email]);

        if ($result === false || empty($result)) {
            echo "Erro ao buscar usuário ou resultado vazio";
            exit;

        }

        $count = (int) $result[0]['COUNT(*)'];

        if ($count > 0) {
            echo "Usuario encontrado";

        } else {
            echo "Usuario não encontrado";
        }
    }
}
