<?php

namespace App\Controller\Sell;

use App\Controller\AbstractController;

class NewSellController extends AbstractController
{
    public function index(array $requestData): void
    {
        $this->render('sells/newSell.php');
    }
}
