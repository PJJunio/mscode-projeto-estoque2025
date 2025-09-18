<?php

namespace App\Controller\Category;

use App\Controller\AbstractController;
use App\Model\Category;

class NewCategoryController extends AbstractController
{
    public function index(array $requestData): void
    {
        $model = new Category();

        $error = null;

        if (!empty($_POST)) {
            $name = $_POST['nome'];

            if ($this->model)

            $error = $name
        }

        $this->render('category/newCategory.php', ['error' => $error]);
    }
}
