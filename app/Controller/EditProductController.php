<?php

namespace App\Controller;

use App\Database\Query;
use App\Model\Product;

class EditProductController extends AbstractController
{
    private Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function index(array $requestData): void
    {
        $productId = $_POST['id'] ?? $requestData['id'] ?? null;

        if (!$productId) {
            $this->redirectToError('ID do produto não especificado.');
            return;
        }

        $model = new Product();
        $error = null;

        $productDataArray = $this->query->select('produto', 'id = :id', [':id' => $productId]);

        if (!$productDataArray) {
            $this->redirectToError('Produto não encontrado.');
            return;
        }
        $productData = $productDataArray[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['categoriaId']) && !empty($_POST['quantidade']) && !empty($_POST['valor'])) {
                $model->editProduct(
                    $_POST['id'],
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['categoriaId'],
                    $_POST['quantidade'],
                    $_POST['valor']
                );

                $this->redirect('/');
                return;
            } else {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';

                $productData['nome'] = $_POST['nome'];
                $productData['descricao'] = $_POST['descricao'];
                $productData['categoria_id'] = $_POST['categoriaId'];
                $productData['quantidade_disponivel'] = $_POST['quantidade'];
                $productData['valor'] = $_POST['valor'];

            }
        }

        $this->render('editProduct.php', [
            'product' => $productData,
            'error' => $error
        ]);
    }
}
