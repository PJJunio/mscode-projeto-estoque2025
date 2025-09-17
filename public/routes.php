<?php

use App\Controller\AppController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoffController;
use App\Controller\Category\NewCategoryController;
use App\Controller\Category\CategoryController;
use App\Controller\EditProductController;
use App\Controller\Error\ErrorController;
use App\Controller\Error\NotFoundController;
use App\Controller\ProductController;

$router = [
    'routes' => [
        '/' => AppController::class,
        '/login' => LoginController::class,
        '/logoff' => LogoffController::class,
        '/error' => ErrorController::class,
        '/product' => ProductController::class,
        '/product/new' => ProductController::class,
        '/product/edit' => EditProductController::class,
        '/category' => CategoryController::class,
        '/new_category' => NewCategoryController::class,
    ],
    'default' => NotFoundController::class
];
