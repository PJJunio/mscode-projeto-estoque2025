<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../../app/Database/Query.php';

$query = new \App\Database\Query;
$data['categories'] = $query->select('categoria');
?>

<main>
  <div class="container py-5">
    <div class="mb-4">
      <h1>Novo produto</h1>
    </div>

    <div class="w-50 mt-2">
      <form method="POST" action="/product/new">
        <?php if (!empty($data['error'])) {
          echo $data['error'];
        } ?>
        <div class="mb-3">
          <label for="nome" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($data['formData']['nome'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição:</label>
          <textarea class="form-control" id="descricao" name="descricao" style="resize:none;" rows="5"><?php echo htmlspecialchars($data['formData']['descricao'] ?? ''); ?></textarea>
        </div>


        <div class="row">
          <div class="mb-3 col-4">
            <label for="categoriaId" class="form-label">Categoria:</label>
            <select class="form-select" id="categoriaId" name="categoriaId">
              <option selected disabled>Selecione...</option>
              <?php
              if (!empty($data['categories'])) {
                foreach ($data['categories'] as $category) {
                  $isSelected = (isset($data['formData']['categoriaId']) && $data['formData']['categoriaId'] == $category['id']) ? 'selected' : '';
                  echo "<option value=\"{$category['id']}\" {$isSelected}>" . htmlspecialchars($category['nome']) . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="mb-3 col-4">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($data['formData']['quantidade'] ?? ''); ?>">
          </div>
          <div class="mb-3 col-4">
            <label for="valor" class="form-label">Valor:</label>
            <input type="text" class="form-control" id="valor" name="valor" value="<?php echo htmlspecialchars($data['formData']['valor'] ?? ''); ?>">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
    </div>
  </div>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
