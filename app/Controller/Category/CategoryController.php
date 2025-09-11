<?php

namespace App\Controller\Category;

use App\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function index (array $requestData):void
    {
        $this->render('category/category.php');
    }
}
