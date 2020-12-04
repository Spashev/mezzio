<?php  

declare(strict_types=1);

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Session\PhpSession;
use Mezzio\Authentication\UserRepositoryInterface;
use Mezzio\Authentication\UserRepository\PdoDatabase;

return [
    'dependencies' => [
        'aliases' => [
            AuthenticationInterface::class => PhpSession::class,
            UserRepositoryInterface::class => PdoDatabase::class,
        ],
    ],

    'authentication' => [
        'redirect' => '/login',
    ],
];