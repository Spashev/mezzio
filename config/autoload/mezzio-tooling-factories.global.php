<?php

/**
 * This file generated by Mezzio\Tooling\Factory\ConfigInjector.
 *
 * Modifications should be kept at a minimum, and restricted to adding or
 * removing factory definitions; other dependency types may be overwritten
 * when regenerating this file via mezzio-tooling commands.
 */
 
declare(strict_types=1);

return [
    'dependencies' => [
        'factories' => [
            App\Middleware\CsrfTokenMiddleware::class => App\Middleware\CsrfTokenMiddlewareFactory::class,
            App\Todo\TodoSaveMiddleware::class => App\Todo\TodoSaveMiddlewareFactory::class,
            AuthUser\Actions\LoginAction::class => AuthUser\Actions\LoginActionFactory::class,
            AuthUser\Actions\RegistorAction::class => AuthUser\Actions\RegistorActionFactory::class,
            AuthUser\AuthenticationMiddleware::class => AuthUser\AuthenticationMiddlewareFactory::class,
            AuthUser\Middleware\AuthenticationMiddleware::class => AuthUser\Middleware\AuthenticationMiddlewareFactory::class,
        ],
    ],
];
