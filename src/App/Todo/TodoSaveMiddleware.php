<?php

declare(strict_types=1);

namespace App\Todo;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Laminas\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\EmptyResponse;
use Mezzio\Csrf\CsrfMiddleware;
use Zend\Db\Adapter\AdapterInterface;

class TodoSaveMiddleware implements MiddlewareInterface
{
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    { 
        $sql = new Sql($this->adapter);

        $data = $request->getParsedBody();

        if(!isset($data['status'])) {
            $data['status'] = 'off';
        }

        $insert = $sql->insert();
        $insert->into('tasks');
        $insert->columns([
            'title',
            'description',
            'status'
        ]);
        $insert->values([
            $data['title'],
            $data['description'],
            $data['status']
        ]);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
        
        return new RedirectResponse('/todo');

    }
}
