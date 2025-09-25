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
        $produtoArr = $this->query->select('produto', 'nome = :nome', [':nome' => $produto], 'id, quantidade_disponivel');
        if (!$produtoArr || !isset($produtoArr[0])) {
            return false;
        }
        $produto = $produtoArr[0];

        $sell = $this->query->insert('venda', ['data_venda' => date('Y-m-d h:i:s'), 'cpf_cliente' => $cpf, 'status' => $status]);

        $precoArr = $this->query->select('produto', 'id = :id', [':id' => $produto['id']], 'valor');
        if (!$precoArr || !isset($precoArr[0])) {
            return false;
        }
        $preco = $precoArr[0]['valor'];

        $this->query->insert('venda_item', ['venda_id' => $sell, 'produto_id' => $produto['id'], 'quantidade' => $quantidade, 'preco_unitario' => $preco]);

        $this->query->updateDecrement('produto', 'quantidade_disponivel', $quantidade, 'id = :id', [':id' => $produto['id']]);

        return true;
    }

    public function checkQuantity($produto, $quantidade)
    {
        $produtoArr = $this->query->select('produto', 'nome = :nome', [':nome' => $produto], 'quantidade_disponivel');
        if (!$produtoArr || !isset($produtoArr[0]['quantidade_disponivel'])) {
            return false;
        }
        if ($produtoArr[0]['quantidade_disponivel'] < $quantidade) {
            return false;
        }
        return true;
    }

    public function editSell($sellId, $cpf, $produto, $status, $quantidade)
    {
        $venda = $this->query->select('venda', 'id = :id', [':id' => $sellId]);
        $item = $this->query->select('venda_item', 'venda_id = :id', [':id' => $sellId]);
        // DEBUG TEMPORÁRIO
        if (!$venda || count($venda) == 0) {
            error_log('DEBUG: Venda não encontrada para id=' . $sellId);
            return 'venda_nao_encontrada';
        }
        if (!$item || count($item) == 0) {
            error_log('DEBUG: Venda_item não encontrada para venda_id=' . $sellId);
            return 'venda_nao_encontrada';
        }
        $oldQuantidade = $item[0]['quantidade'];
        $oldProdutoId = $item[0]['produto_id'];

        $produtoArr = $this->query->select('produto', 'id = :id', [':id' => $produto], 'id, quantidade_disponivel');
        if (!$produtoArr || !isset($produtoArr[0])) {
            return 'produto_nao_encontrado';
        }
        $produtoObj = $produtoArr[0];

        $precoArr = $this->query->select('produto', 'id = :id', [':id' => $produtoObj['id']], 'valor');
        if (!$precoArr || !isset($precoArr[0]['valor'])) {
            return 'produto_nao_encontrado';
        }
        $preco = $precoArr[0]['valor'];

        if ($oldProdutoId != $produtoObj['id']) {
            $this->query->updateIncrement('produto', 'quantidade_disponivel', $oldQuantidade, 'id = :id', [':id' => $oldProdutoId]);

            if ($produtoObj['quantidade_disponivel'] < $quantidade) {
                return 'estoque_insuficiente';
            }
            $this->query->updateDecrement('produto', 'quantidade_disponivel', $quantidade, 'id = :id', [':id' => $produtoObj['id']]);
        } else {
            $diff = $quantidade - $oldQuantidade;
            if ($diff > 0) {
                if ($produtoObj['quantidade_disponivel'] < $diff) {
                    return 'estoque_insuficiente';
                }
                $this->query->updateDecrement('produto', 'quantidade_disponivel', $diff, 'id = :id', [':id' => $produtoObj['id']]);
            } elseif ($diff < 0) {
                $this->query->updateIncrement('produto', 'quantidade_disponivel', abs($diff), 'id = :id', [':id' => $produtoObj['id']]);
            }
        }

        $this->query->update('venda_item', [
            'produto_id' => $produtoObj['id'],
            'quantidade' => $quantidade,
            'preco_unitario' => $preco
        ], 'venda_id = :id', [':id' => $sellId]);

        $this->query->update('venda', [
            'data_venda' => date('Y-m-d H:i:s'),
            'cpf_cliente' => $cpf,
            'status' => $status
        ], 'id = :id', [':id' => $sellId]);

        return true;

    }
}
