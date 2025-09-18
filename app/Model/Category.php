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

    public function deleteCategory($categoryId)
    {
        return $this->query->delete('categoria ', 'id = :id', [':id' => $categoryId]);
    }

}
