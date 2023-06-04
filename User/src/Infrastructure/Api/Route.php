<?php

namespace Infrastructure\Api;

use Infrastructure\Api\Controller\AddressController;
use Infrastructure\Api\Controller\UserController;
use Slim\App;

class Route
{
    public static function make(App $app): void
    {
        $app->get('/users', [UserController::class, 'all']);
        $app->get('/users/{id}', [UserController::class, 'find']);
        $app->post('/users', [UserController::class, 'create']);

        $app->post('/address/{userId}', [AddressController::class, 'create']);
    }
}