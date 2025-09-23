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

        if (!empty($_GET['sell'])) {
            $model->decrementOne($_GET['sell']);
            header('Location: /');
            exit;
        }

        $error = null;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['nome']) || empty($formData['descricao']) || empty($formData['categoriaId']) || empty($formData['quantidade']) || empty($formData['valor'])) {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';
            } else {
                $success = $model->newProduct(
                    $formData['nome'],
                    $formData['descricao'],
                    $formData['categoriaId'],
                    $formData['quantidade'],
                    $formData['valor']
                );

                if ($success) {
                    header('Location: /');
                    exit;
                } else {
                    $error = '<div class="alert alert-danger" role="alert">Já existe um produto com este nome nesta categoria.</div>';
                }
            }
        }

        $this->render('newProduct.php', [
            'error' => $error,
            'formData' => $formData
        ]);
    }
}
