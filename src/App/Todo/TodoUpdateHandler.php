<?php

declare(strict_types=1);

namespace App\Todo;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse; 
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class TodoUpdateHandler implements RequestHandlerInterface
{

    /** @var string */
    private $containerName;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(string $containerName, Router\RouterInterface $router, ?TemplateRendererInterface $template = null, Adapter $adapter) {
        $this->containerName = $containerName;
        $this->router        = $router;
        $this->template      = $template;
        $this->adapter = $adapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        
        $sql = new Sql($this->adapter);

        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        if($request->getAttribute('_method') == 'PUT') {
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();
            
            if(!isset($data['status'])) {
                $data['status'] = 'off';
            }

            $insert = $sql->insert();
            $insert->into('tasks');
            $insert->columns(array_keys($data));
            $insert->values(array_values($data));
            $statement = $sql->prepareStatementForSqlObject($insert);
            $statement->execute();
            
            return new RedirectResponse('/todo');
        }

        $select = $sql->select();
        $select->from('tasks');
        $select->where(
            sprintf('id = %s', $id)
        );

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        foreach($results as $result) {
            $data['task'] = $result;
        }

        return new HtmlResponse($this->template->render('todo::edit', $data));
    }
}
