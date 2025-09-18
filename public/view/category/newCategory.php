<?php
require_once __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1>Nova categoria</h1>
        </div>

        <div class="w-50 mt-2">
            <form method="POST" action="/category/new">
                <?php if (!empty($data['error'])) {
                    echo $data['error'];
                } ?>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
            </form>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>