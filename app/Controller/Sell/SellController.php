<?php

namespace App\Controller\Sell;

use App\Controller\AbstractController;

class SellController extends AbstractController
{
    public function index(array $requestData): void
    {
        $this->render('sells/sell.php');
    }
}
