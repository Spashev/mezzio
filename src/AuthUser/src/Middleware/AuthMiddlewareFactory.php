<?php

declare(strict_types=1);

namespace AuthUser\Middleware;

use Psr\Container\ContainerInterface;
use AuthUser\Middleware\AuthMiddleware;


class AuthMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AuthMiddleware
    {
        return new AuthMiddleware();
    }
}
