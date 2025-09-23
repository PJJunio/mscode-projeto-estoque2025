<?php

namespace App\Model;

use App\Database\Query;

class Sell
{
    private Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function newSell($cpf, $produto, $status, $quantidade)
    {
        $produto = $this->query->select('produto', 'nome = :nome', [':nome' => $produto], 'id, quantidade_disponivel');

        $sell = $this->query->insert('venda', ['data_venda' => date('Y-m-d h:i:s'), 'cpf_cliente' => $cpf, 'status' => $status]);

        $preco = $this->query->select('produto', 'id = :id', [':id' => $produto[0]['id']], 'valor');

        $this->query->insert('venda_item', ['venda_id' => $sell, 'produto_id' => $produto[0]['id'], 'quantidade' => $quantidade, 'preco_unitario' => $preco[0]['valor']]);

        $this->query->update('produto', ['quantidade_disponivel' => $produto[1]['quantidade_disponivel'] - $quantidade], 'id = :id', [':id' => $produto]);

        return true;
    }

    public function checkQuantity($produto, $quantidade)
    {
        $produto = $this->query->select('produto', 'nome = :nome', [':nome' => $produto], 'quantidade_disponivel');

        if ($produto[0]['quantidade_disponivel'] < $quantidade) {
            return false;
        }

        return true;
    }
}
