<?php

namespace App\Controller;

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

        if (!empty($_GET['delete'])) {
            if ($model->deleteCategory($_GET['delete'])) {
                header('Location; /category');
                exit;

            } else {
                $this->redirectToError('Categoria com produto cadastrado.');
                exit;
            }
        }
    }
}
