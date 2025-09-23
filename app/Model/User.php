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

    public function checkPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    public function createUser(string $user, string $email, string $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->conn->insert('usuario', ['nome' => $user, 'email' => $email, 'senha' => $hashedPassword]);
    }
}
