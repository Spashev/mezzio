<?php

declare(strict_types=1);

namespace App\Todo;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TodoPageHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        $adapter = $container->get('adapter');

        return new TodoPageHandler($template, $adapter);
    }
}
