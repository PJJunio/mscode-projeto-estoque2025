<?php

namespace App\Controller\Category;

use App\Controller\AbstractController;
use App\Database\Query;
use App\Model\Category;

class CategoryController extends AbstractController
{
    private Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function index(array $requestData): void
    {
        $model = new Category;
        $error = null;

        if (!empty($_GET['delete'])) {
            if ($model->deleteCategory($_GET['delete'])) {
                header('Location: /category');
                exit;

            } else {
                $error = '<div class="alert alert-danger" role="alert">Categoria vinculada a um ou mais produtos!</div>';

            }
        }

        $this->render('category/category.php', ['error' => $error]);
    }
}
