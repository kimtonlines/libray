<?php

use Kimt\Controller\ArticleController;

$container = $app->getContainer();

// Register component Twig on container 
$container['view'] = function ($container) {

    $templatePath = __DIR__.'/../templates/views';
    $view = new \Slim\Views\Twig($templatePath);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};

$container['db'] = function () {

    $db = new PDO('mysql:host=localhost;dbname=library','root','root');
    
    return $db;
};