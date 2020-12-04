<?php

declare(strict_types=1);

namespace AuthUser;

/**
 * The configuration provider for the AuthUser module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                AuthUser\Actions\LoginAction::class => AuthUser\Factory\Actions\LoginActionFactory::class,
                AuthUser\Actions\RegistorAction::class => AuthUser\Factory\Actions\RegistorActionFactory::class,
            ],
            'factories'  => [
                AuthUser\Middleware\AuthMiddleware::class => AuthUser\Middleware\AuthMiddlewareFactory::class,
            ],
        ];
    }

    /**
     * Returns the default module configuration
     *
     * @return array
     */
    public function getConfig() : array
    {
        return [
            'paths' => [
                'enable_registration' => true,
                'enable_username' => false,
                'enable_display_name' => true,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'auth' => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
