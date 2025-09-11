<?php
require_once __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="container py-5">
      <div class="mb-4 d-flex flex-row justify-content-between">
        <h1>Categorias</h1>
        <div>
          <a href="new_category" class="btn btn-primary"><i class="bi bi-plus"></i>Nova categoria</a>
        </div>
      </div>

      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col-1 text-align-right">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Informática</td>
            <td class="col-1 text-align-right">
              <button class="btn btn-secondary btn-sm" title="Editar"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
        </tbody>

      </table>
    </div>
</main>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>