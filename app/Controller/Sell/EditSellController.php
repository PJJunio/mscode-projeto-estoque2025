<?php

namespace App\Controller\Sell;

use App\Controller\AbstractController;
use App\Model\Sell;

class EditSellController extends AbstractController
{
    public function index(array $requestData): void
    {

        $model = new Sell();
        $formData = [];

        if (isset($requestData['id'])) {
            $query = new \App\Database\Query;
            $venda = $query->select('venda', 'id = :id', [':id' => $requestData['id']]);
            $item = $query->select('venda_item', 'venda_id = :id', [':id' => $requestData['id']]);
            if ($venda && $item) {
                $formData = [
                    'cpf_cliente' => $venda[0]['cpf_cliente'] ?? '',
                    'produto' => $item[0]['produto_id'] ?? '',
                    'status' => $venda[0]['status'] ?? '',
                    'quantidade' => $item[0]['quantidade'] ?? '',
                ];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cpf = preg_replace('/[^0-9]/','', $_POST['cpf_cliente']);
            
            if (empty($_POST['cpf_cliente']) || empty($_POST['produto']) || empty($_POST['status']) || empty($_POST['quantidade'])) {
                $error = '<div class="alert alert-danger" role="alert">Preencha todos os campos!</div>';

            } elseif (strlen($cpf) != 11) {
                $error = '<div class="alert alert-danger" role="alert">Insira um CPF valido!</div>';

            } elseif ($_POST['status'] != 'finalizada' && $_POST['status'] != 'pendente' && $_POST['status'] != 'cancelada') {
                $error = '<div class="alert alert-danger" role="alert">Erro ao escolher status!</div>';

            } elseif ($_POST['quantidade'] <= 0) {
                $error = '<div class="alert alert-danger" role="alert">O valor precisa ser superior a 0!</div>';

            } else {
                $idVenda = $_POST['id'] ?? ($requestData['id'] ?? null);
                $result = $model->editSell($idVenda, $_POST['cpf_cliente'], $_POST['produto'], $_POST['status'], $_POST['quantidade']);
                if ($result === true) {
                    $formData = [];
                    $error = '<div class="alert alert-success" role="alert">Venda alterada com sucesso!</div>';
                } else {
                    // Mensagens específicas
                    if ($result === 'produto_nao_encontrado') {
                        $error = '<div class="alert alert-danger" role="alert">Produto não encontrado!</div>';
                    } elseif ($result === 'estoque_insuficiente') {
                        $error = '<div class="alert alert-danger" role="alert">Estoque insuficiente para o produto selecionado!</div>';
                    } elseif ($result === 'venda_nao_encontrada') {
                        $error = '<div class="alert alert-danger" role="alert">Venda não encontrada!</div>';
                    } else {
                        $error = '<div class="alert alert-danger" role="alert">Valor inválido!</div>';
                    }
                }
            }
        }
        $this->render('sells/editSell.php', [
            'formData' => $formData,
            'error' => $error
        ]);
    }
}
