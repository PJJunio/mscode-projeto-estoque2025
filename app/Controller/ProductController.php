<?php

namespace App\Controller;

use App\Database\Query;
use App\Model\Product;

class ProductController extends AbstractController
{

    private Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function index(array $requestData): void
    {
        $model = new Product();

        if (!empty($_GET['delete'])) {
            $model->deleteProduct($_GET['delete']);
            header('Location: /');
            exit;

        }

        if (!empty($_GET['add'])) {
            $model->incrementOne($_GET['add']);
            header('Location: /');
            exit;
        }

        if (!empty($_GET['sell'])) {
            $model->decrementOne($_GET['sell']);
            // header('Location: /');
            exit;
        }

        $this->render('newProduct.php', []);
    }
}
