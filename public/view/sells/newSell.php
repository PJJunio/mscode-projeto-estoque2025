<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../../../app/Database/Query.php';

$query = new \App\Database\Query;

$produtos = $query->select('produto');
?>

<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1>Novo produto</h1>
        </div>

        <div class="w-50 mt-2">
            <form method="POST" action="/sell/new">
                <?php if (!empty($data['error'])) {
                    echo $data['error'];
                } ?>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                        value="<?php echo htmlspecialchars($data['formData']['nome'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="cpf_cliente" class="form-label">CPF do Cliente:</label>
                    <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente"
                        value="<?php echo htmlspecialchars($data['formData']['cpf_cliente'] ?? ''); ?>">
                </div>
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="produto" class="form-label">Produto:</label>
                        <select class="form-select" id="produto" name="produto">
                            <option selected disabled>Selecione...</option>
                            <?php
                            if (is_array($produtos) && count($produtos) > 0) {
                                foreach ($produtos as $produto) {
                                    $isSelected = (isset($data['formData']['produto']) && $data['formData']['produto'] == $produto['nome']) ? 'selected' : '';
                                    echo "<option value=\"{$produto['nome']}\" {$isSelected}>" . htmlspecialchars($produto['nome']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status">
                            <option selected disabled>Selecione...</option>
                            <?php
                            $statusOptions = ['Pendente' => 'pendente', 'Finalizada' => 'finalizada', 'Cancelada' => 'cancelada'];
                            foreach ($statusOptions as $label => $value) {
                                $isSelected = (isset($data['formData']['status']) && $data['formData']['status'] == $value) ? 'selected' : '';
                                echo "<option value=\"{$value}\" {$isSelected}>{$label}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="quantidade" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade"
                            value="<?php echo htmlspecialchars($data['formData']['quantidade'] ?? ''); ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/../includes/footer.php';

?>