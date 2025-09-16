<?php

namespace App\Model;

use App\Database\Query;

class Product
{
    private Query $conn;

    public function __construct()
    {
        $this->conn = new Query();
    }

    public function deleteProduct($productId)
    {
        $this->conn->delete('produto', 'id = :id', [':id' => $productId]);
        return true;
    }

    public function incrementOne($productId)
    {
        $this->conn->insertOne('produto', 'quantidade_disponivel', 'id = :id', [':id' => $productId]);
        return true;
    }

    public function decrementOne($productId)
    {
        $currentValue = $this->conn->select('produto', 'id = :id', [':id' => $productId], 'quantidade_disponivel');

        if ((int) $currentValue['quantidade_disponivel'] == 0) {
            var_dump($currentValue);
            $this->conn->delete('produto', 'id = :id', [':id' => $productId]);
            return true;
        }

        $this->conn->decrementOne('produto', 'quantidade_disponivel', 'id = :id', [':id' => $productId]);
        return true;
    }
}
