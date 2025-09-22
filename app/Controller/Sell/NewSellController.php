<?php

namespace App\Controller\Sell;

use App\Controller\AbstractController;

class NewSellController extends AbstractController
{
    public function index(array $requestData): void
    {
        $error = null;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['nome']) || empty($formData['cpf_cliente']) || empty($formData['produto']) || empty($formData['status']) || empty($formData['quantidade'])) {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';

            } else {
                $nome = $formData['nome'];
                $cpf = $formData['cpf_cliente'];
                $produto = $formData['produto'];
                $status = $formData['status'];
                $quantidade = $formData['quantidade'];

                echo $nome . PHP_EOL . $cpf . PHP_EOL . $produto . PHP_EOL . $status . PHP_EOL . $quantidade;
            }

        }

        $this->render('sells/newSell.php', [
            'error' => $error,
            'formData' => $formData
        ]);
    }
}
