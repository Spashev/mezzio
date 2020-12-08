<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;

class RegistorActionFactory
{
    public function __invoke(ContainerInterface $container) : RegistorAction
    {
        return new RegistorAction(
            $container->get(TemplateRendererInterface::class),
            $container->get(Adapter::class)
        );
    }
}
