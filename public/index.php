<?php

// Start PHP session
session_start(); //by default requires session storage

require_once __DIR__.'/../vendor/autoload.php';

use Slim\App;

$config = [
    'settings' => [
        'displayErrorDetails' => true,

    ],
];

$app = new App($config);
//$app->add(new \Slim\Csrf\Guard);

require_once '../config/container.php';

require_once '../config/router.php';
