<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class CsrfTokenMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : CsrfTokenMiddleware
    {
        return new CsrfTokenMiddleware();
    }
}
