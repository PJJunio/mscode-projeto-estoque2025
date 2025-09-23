<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../../app/Database/Query.php';

$query = new \App\Database\Query;

$produtos = $query->select('produto');
$usuario = $query->select('usuario', 'nome = :nome', [':nome' => $_SESSION['user']]);

?>

<main>
    <div class="container py-5">
        <h1>Bem vindo <?= $usuario[0]['nome'] ?>!</h1>
        <div class="container py-5">
            <div class="mb-4 d-flex flex-row justify-content-between">
                <h2>Produtos</h2>
                <div>
                    <a href="product" class="btn btn-primary"><i class="bi bi-plus"></i>Novo produto</a>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Qtd. Disponível</th>
                        <th scope="col-2 text-align-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($produtos) && count($produtos) > 0) {
                        foreach ($produtos as $produto) {
                            $categoria = $query->select('categoria', 'id = :id', [':id' => $produto['categoria_id']], 'nome');
                            ?>
                            <tr>
                                <th scope="row"><?= $produto['id'] ?></th>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['descricao'] ?></td>
                                <td><?= $categoria[0]['nome'] ?></td>
                                <td><?= 'R$ ' . number_format($produto['valor'], 2, ',', '.') ?></td>
                                <td><?= $produto['quantidade_disponivel'] ?></td>
                                <td class="col-2 d-flex gap-1 w-auto flex-wrap">
                                    <a href="product/edit/?id=<?= $produto['id'] ?>" class="btn btn-secondary btn-sm"
                                        title="Editar produto"><i class="bi bi-pencil"></i></a>
                                    <a href='product?delete=<?= $produto['id'] ?>' class="btn btn-danger btn-sm"
                                        title="Excluir"><i class="bi bi-trash"></i></a>
                                    <a href='product?sell=<?= $produto['id'] ?>' class="btn btn-primary btn-sm"
                                        title="Vender produto (decrementar 1)">Vender</a>
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