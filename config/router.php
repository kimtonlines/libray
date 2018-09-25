<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Kimt\Controller\ArticleController;

$app->get('/articles', ArticleController::class.':index')->setName('articles');

$app->get('/articles/create', ArticleController::class.':create')->setName('create');
$app->post('/articles/create', ArticleController::class.':create');

$app->get('/articles/edit/{id:[0-9]+}', ArticleController::class.':edit')->setName('edit');
$app->put('/articles/edit/{id:[0-9]+}', ArticleController::class.':edit');

$app->get('/articles/show/{id:[0-9]+}', ArticleController::class.':show')->setName('show');

$app->delete('/article/{id:[0-9]+}', ArticleController::class.':remove')->setName('remove');

$app->run();