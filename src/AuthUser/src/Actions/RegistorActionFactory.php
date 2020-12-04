<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class RegistorActionFactory
{
    public function __invoke(ContainerInterface $container) : RegistorAction
    {
        return new RegistorAction($container->get(TemplateRendererInterface::class));
    }
}
