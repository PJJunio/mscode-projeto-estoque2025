<?php
require_once __DIR__ . '/includes/header.php';
$product = $data['product'] ?? [];
?>

<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1>Editar produto</h1>
        </div>

        <div class="w-50 mt-2">
            <form method="POST" action="/product/edit">
                <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">
                <?php if (!empty($data['error'])) {
                    echo $data['error'];
                } ?>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $product['nome'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao" style="resize:none;" rows="5"><?= $product['descricao'] ?? '' ?></textarea>
                </div>
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="categoriaId" class="form-label">Categoria Id:</label>
                        <input type="number" class="form-control" id="categoriaId" name="categoriaId" value="<?= $product['categoria_id'] ?? '' ?>">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="quantidade" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= $product['quantidade_disponivel'] ?? '' ?>">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="valor" class="form-label">Valor:</label>
                        <input type="text" class="form-control" id="valor" name="valor" value="<?= $product['valor'] ?? '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
