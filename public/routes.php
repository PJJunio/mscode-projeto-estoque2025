<?php

use App\Controller\AppController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoffController;
use App\Controller\Auth\RegisterController;
use App\Controller\Category\NewCategoryController;
use App\Controller\Category\CategoryController;
use App\Controller\EditProductController;
use App\Controller\Error\ErrorController;
use App\Controller\Error\NotFoundController;
use App\Controller\ProductController;
use App\Controller\Sell\NewSellController;
use App\Controller\Sell\SellController;

$router = [
    'routes' => [
        '/' => AppController::class,
        '/login' => LoginController::class,
        '/register' => RegisterController::class,
        '/logoff' => LogoffController::class,
        '/error' => ErrorController::class,
        '/product' => ProductController::class,
        '/product/new' => ProductController::class,
        '/product/edit' => EditProductController::class,
        '/category' => CategoryController::class,
        '/category/new' => NewCategoryController::class,
        '/sell' => SellController::class,
        '/sell/new' => NewSellController::class,
    ],
    'default' => NotFoundController::class
];
