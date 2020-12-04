<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;


class LoginActionFactory
{
    public function __invoke(ContainerInterface $container) : LoginAction
    {
        return new LoginAction($container->get(TemplateRendererInterface::class));
    }
}
