<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MS Code - Projeto Estoque 2025</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="border-bottom mb-2">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center align-items-center py-3">
                <a href="/"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <img class="me-2" src="assets/images/logotipo.svg" width="53">
                    <span class="fs-4">MS Code - Estoque</span>
                </a>

                <ul class="nav nav-pills d-flex align-items-center">
                    <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Início</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Vendas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="vendas_realizadas.html">Vendas realizadas</a></li>
                            <li><a class="dropdown-item" href="nova_venda.html">Nova venda</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Produtos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/">Estoque</a></li>
                            <li><a class="dropdown-item" href="category">Categorias</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="login" class="btn btn-outline-danger m-0 ms-4"
                            aria-current="page">Sair</a></li>
                </ul>
            </header>
        </div>
    </div>