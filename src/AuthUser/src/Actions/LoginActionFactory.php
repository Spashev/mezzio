<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class LoginActionFactory
{
    public function __invoke(ContainerInterface $container) : LoginAction
    {
        $authentication = $container->has(AuthenticationInterface::class)
            ? $container->get(AuthenticationInterface::class)
            : ($container->has(ExpressiveAuthenticationInterface::class)
                ? $container->get(ExpressiveAuthenticationInterface::class)
                : null);
        dd($authentication);
        return new LoginAction(
            $container->get(TemplateRendererInterface::class), 
            $container->get(AdapterInterface::class),
            $authentication
        );
    }
}
