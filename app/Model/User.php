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

    public function getUserByEmail(string $email): ?array
    {
        $result = $this->conn->select('usuario', 'email = ?', [$email], 'email, senha, nome');

        return $result[0] ?? null;
    }

    // public function checkPassword(string $password, string $hashedPassword): bool
    // {
    //     return password_verify($password, $hashedPassword);
    // }
}
