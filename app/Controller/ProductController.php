<?php

namespace App\Controller;
class ProductController extends AbstractController
{
    public function index (array $requestData): void
    {
        $this->render('newProduct.php', [

        ]);
    }
}
