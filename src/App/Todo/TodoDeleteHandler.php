<?php

declare(strict_types=1);

namespace App\Todo;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse; 
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class TodoDeleteHandler implements RequestHandlerInterface
{
    public function __construct() 
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        
        $adapter = new Adapter([
            'driver' => 'Pdo',
            'dsn'    => 'mysql:dbname=mezzio;host=localhost;charset=utf8',
            'username' => 'admin',
            'password' => '1q2w3e4r'
        ]);
        $sql = new Sql($adapter);

        $insert = $sql->delete();
        $insert->from('tasks')->where(
            sprintf('id = %s', $id)
        );
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
        
        return new RedirectResponse('/todo');
    }
}
