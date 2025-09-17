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
        $result = $this->conn->select('produto', 'id = :id', [':id' => $productId], 'quantidade_disponivel');
        $currentValue = $result[0];

        if ((int) $currentValue['quantidade_disponivel'] <= 0) {
            $this->conn->delete('produto', 'id = :id', [':id' => $productId]);
            return true;
        }

        $this->conn->decrementOne('produto', 'quantidade_disponivel', 'id = :id', [':id' => $productId]);
        return true;
    }

    public function newProduct($nome, $descricao, $categoriaId, $quantidade, $valor)
    {
        $this->conn->insert('produto', [
            'nome' => $nome,
            'descricao' => $descricao,
            'categoria_id' => $categoriaId,
            'quantidade_inicial' => $quantidade,
            'quantidade_disponivel' => $quantidade,
            'valor' => $valor
        ]);
        return true;
    }

    public function editProduct($id, $nome, $descricao, $categoriaId, $quantidade, $valor)
    {
        $this->conn->update('produto', [
            'nome' => $nome,
            'descricao' => $descricao,
            'categoria_id' => $categoriaId,
            'quantidade_disponivel' => $quantidade,
            'valor' => $valor
        ], 'id = :id', [':id' => $id]);

        return true;
    }
}
