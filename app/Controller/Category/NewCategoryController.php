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

        //PAROU AQUI, TEM QUE CRIAR A VALIDAÇÂO PARA VER SE JÁ TEM ALGUMA CATEGORIA COM ESSE NOME
        if (!empty($_POST)) {
            if ($model->createCategory($_POST['nome'])) {
            }

        }
        $this->render('category/newCategory.php', ['error' => $error]);
    }
}
