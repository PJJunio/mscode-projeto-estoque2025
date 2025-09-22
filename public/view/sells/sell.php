<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../../../app/Database/Query.php';

$query = new \App\Database\Query;

$vendas = $query->select('venda');
$itens = $query->select('venda_item');
?>

<main>
    <div class="container py-5">
        <div class="container py-5">
            <div class="mb-4 d-flex flex-row justify-content-between">
                <h1>Produtos</h1>
                <div>
                    <a href="sell/new" class="btn btn-primary"><i class="bi bi-plus"></i>Nova venda</a>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data da venda</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Qtd.</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($vendas) && count($vendas) > 0) {
                        foreach ($vendas as $venda) {
                            if (is_array($itens) && count($itens) > 0) {
                                foreach ($itens as $item) {
                                    $valor = $item['preco_unitario'] * $item['quantidade'];
                                    $produto = $query->select('produto', 'id = :id', [':id' => $item['produto_id']], 'nome');
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $venda['id'] ?></th>
                                        <td><?= $produto[0]['nome'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($venda['data_venda'])) ?></td>
                                        <td><?= $venda['cpf_cliente'] ?></td>
                                        <td><?= $item['quantidade'] ?></td>
                                        <td><?= 'R$ ' . number_format($valor, 2, ',', '.') ?></td>
                                        <td><?= $venda['status'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum produto encontrado.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/../includes/footer.php';

?>