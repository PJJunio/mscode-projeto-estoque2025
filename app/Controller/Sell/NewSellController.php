<?php

namespace App\Controller\Sell;

use App\Controller\AbstractController;
use App\Model\Sell;

class NewSellController extends AbstractController
{
    public function index(array $requestData): void
    {
        $model = new Sell();
        $error = null;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;
            $cpf = preg_replace('/[^0-9]/','', $_POST['cpf_cliente']);

            if (empty($formData['cpf_cliente']) || empty($formData['produto']) || empty($formData['status']) || empty($formData['quantidade'])) {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';

            } elseif(strlen($cpf) != 11) {
                $error = '<div class="alert alert-danger" role="alert">Insira um CPF valido!</div>';

            } elseif($formData['status'] != 'finalizada' && $formData['status'] != 'pendente' && $formData['status'] != 'cancelada') {
                $error = '<div class="alert alert-danger" role="alert">Erro ao escolher status!</div>';

            } elseif($formData['quantidade'] <= 0) {
                $error = '<div class="alert alert-danger" role="alert">O valor precisa ser superior a 0!</div>';
                
            } elseif($model->editSell($_GET['id'], $formData['cpf_cliente'], $formData['produto'], $formData['status'], $formData['quantidade'])) {
                $formData = [];
                // $error = '<div class="alert alert-success" role="alert">Venda realizada com sucesso!</div>'; //TEM QUE DAR UM JEITO DESSE ERRO APARECER NA LISTA DE SELL;
                header('Location: /sell');

            } else {
                $error = '<div class="alert alert-danger" role="alert">Quantidade indisponivel!</div>';

            }

        }

        $this->render('sells/newSell.php', [
            'error' => $error,
            'formData' => $formData
        ]);
    }
}
