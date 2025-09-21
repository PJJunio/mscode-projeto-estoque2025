<?php

namespace App\Model;

use App\Database\Query;

class Category
{

    public Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function deleteCategory($categoryId): bool
    {
        if ($this->query->delete('categoria ', 'id = :id', [':id' => $categoryId])) {
            return true;

        } else {
            return false;

        }
    }

    public function createCategory($nome)
    {
        $search = $this->query->select('categoria', 'nome = :nome', [':nome' => $nome], 'nome');

        if (!empty($search)) {
            return false;
        }

        $dados = ['nome' => $nome];
        $this->query->insert('categoria', $dados);
        return true;
    }

}
