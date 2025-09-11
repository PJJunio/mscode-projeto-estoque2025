<?php

namespace App\Controller\Category;

use App\Controller\AbstractController;

class NewCategoryController extends AbstractController
{
    public function index(array $requestData): void
    {
        $this->render('category/newCategory.php');
    }
}
