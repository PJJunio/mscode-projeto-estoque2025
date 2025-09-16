<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../../app/Database/Query.php';

$query = new \App\Database\Query;

$produtos = $query->select('produto');

?>

<main>
    <div class="container py-5">
        <div class="container py-5">
            <div class="mb-4 d-flex flex-row justify-content-between">
                <h1>Produtos</h1>
                <div>
                    <a href="new_product" class="btn btn-primary"><i class="bi bi-plus"></i>Novo produto</a>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria Id</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Qtd. Disponível</th>
                        <th scope="col-2 text-align-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($produtos) && count($produtos) > 0) {
                        foreach ($produtos as $produto) {
                            ?>
                            <tr>
                                <th scope="row"><?= $produto['id'] ?></th>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['descricao'] ?></td>
                                <td><?= $produto['categoria_id'] ?></td>
                                <td><?= 'R$ ' . number_format($produto['valor'], 2, ',', '.') ?></td>
                                <td><?= $produto['quantidade_disponivel'] ?></td>
                                <td class="col-2 d-flex gap-1 w-auto flex-wrap">
                                    <button class="btn btn-primary btn-sm" title="Adicionar 1 (incrementar quantidade)"><i
                                            class="bi bi-plus"></i></button>
                                    <button class="btn btn-secondary btn-sm" title="Editar produto"><i
                                            class="bi bi-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></button>
                                    <button class="btn btn-primary btn-sm"
                                        title="Vender produto (decrementar 1)">Vender</button>
                                </td>
                            </tr>
                            <?php
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
require_once __DIR__ . '/includes/footer.php';
?>