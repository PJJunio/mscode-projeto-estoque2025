<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../../app/Database/Query.php';

$product = $data['product'] ?? [];
$query = new \App\Database\Query;
$categories = $query->select('categoria');
?>

<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1>Editar produto</h1>
        </div>

        <div class="w-50 mt-2">
            <form method="POST" action="/product/edit">
                <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
                <?php if (!empty($data['error'])) {
                    echo $data['error'];
                } ?>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($product['nome'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao" style="resize:none;" rows="5"><?= htmlspecialchars($product['descricao'] ?? '') ?></textarea>
                </div>
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="categoriaId" class="form-label">Categoria:</label>
                        <select class="form-select" id="categoriaId" name="categoriaId">
                            <option disabled>Selecione...</option>
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    $isSelected = (isset($product['categoria_id']) && $product['categoria_id'] == $category['id']) ? 'selected' : '';
                                    echo "<option value=\"{$category['id']}\" {$isSelected}>" . htmlspecialchars($category['nome']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="quantidade" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= htmlspecialchars($product['quantidade_disponivel'] ?? '') ?>">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="valor" class="form-label">Valor:</label>
                        <input type="text" class="form-control" id="valor" name="valor" value="<?= htmlspecialchars($product['valor'] ?? '') ?>">
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
