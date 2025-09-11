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
        $sql = $this->conn->select("usuario", "email = '$email'");
        var_dump($sql);

        if (!empty($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
