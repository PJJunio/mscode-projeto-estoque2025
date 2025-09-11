<?php

use App\Controller\AppController;
use App\Controller\Auth\LoginController;
use App\Controller\Category\NewCategoryController;
use App\Controller\Category\CategoryController;
use App\Controller\Error\ErrorController;
use App\Controller\Error\NotFoundController;
use App\Controller\ProductController;

$router = [
    'routes' => [
        '/' => AppController::class,
        '/login' => LoginController::class,
        '/error' => ErrorController::class,
        '/new_product' => ProductController::class,
        '/category' => CategoryController::class,
        '/new_category' => NewCategoryController::class,
    ],
    'default' => NotFoundController::class
];
