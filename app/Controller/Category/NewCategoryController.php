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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nome'])) {
                $error = '<div class="alert alert-danger" role="alert">Pencha o campo!</div>';

            } else if ($model->createCategory($_POST['nome'])) {
                header('Location: /category');
                exit;

            } else {
                $error = '<div class="alert alert-danger" role="alert">Categoria existente</div>';
            }
        }
        $this->render('category/newCategory.php', ['error' => $error]);
    }
}
