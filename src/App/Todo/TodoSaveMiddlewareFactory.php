<?php

declare(strict_types=1);

namespace App\Todo;

use Psr\Container\ContainerInterface;

class TodoSaveMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : TodoSaveMiddleware
    {
        $adapter = $container->get('adapter');
        return new TodoSaveMiddleware($adapter);
    }
}
