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
        $model = new Product();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $model->editProduct(
                    $_POST['id'],
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['categoriaId'],
                    $_POST['quantidade'],
                    $_POST['valor']
                );

                $this->redirect('/');
            } else {
                $this->redirectToError('ID do produto não especificado para edição.');
            }
        }

        if (isset($requestData['id'])) {
            $productId = $requestData['id'];
            $productData = $this->query->select('produto', 'id = :id', [':id' => $productId]);

            if ($productData) {
                $this->render('editProduct.php', ['product' => $productData[0]]);
            } else {
                $this->redirectToError('Produto não encontrado.');
            }
        } else {
            $this->redirectToError('ID do produto não especificado para edição.');
        }
    }
}
