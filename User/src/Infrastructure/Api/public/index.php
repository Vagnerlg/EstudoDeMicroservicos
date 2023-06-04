<?php

use Infrastructure\Api\Route;
use Infrastructure\DependencyInjection;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../../vendor/autoload.php';

AppFactory::setContainer((new DependencyInjection())->make());

$app = AppFactory::create();
$app->addRoutingMiddleware();
Route::make($app);

$app->run();
