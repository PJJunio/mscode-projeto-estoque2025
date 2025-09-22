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
}
