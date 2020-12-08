<?php

declare(strict_types=1);

namespace App\Todo;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mezzio\Csrf\CsrfMiddleware;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class TodoPageHandler implements MiddlewareInterface
{
    /** @var string */
    private $containerName;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template, Adapter $adapter) {
        $this->template = $template;
        $this->adapter = $adapter;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = [
            'forms' => [
                'title' => [
                    'id' => 'title',
                    'label' => 'Title',
                    'type' => 'text', 
                    'placeholde' => 'Enter title...',
                    'class' => 'fomr-control'
                ], 
                'description' => [
                    'id' => 'description',
                    'label' => 'Description',
                    'type' => 'textarea', 
                    'placeholde' => 'Enter description...',
                    'class' => 'fomr-control'
                ],
                'status' => [
                    'btn' => [
                        'id' => 'status',
                        'label' => 'Status',
                        'type' => 'checkbox',
                        'checked' => True
                    ]
                ],
                'buttons' => [
                    'edit' => [
                        'class' => 'btn btn-primary',
                        'route' => 'todo.update',
                        'icon' => 'fa fa-pencil-alt'
                    ],
                    'delete' => [
                        'class' => "btn btn-danger",
                        'route' => 'todo.delete',
                        'icon' => "fa fa-times"
                    ]
                ]
            ],
            'btn' => [
                'add' => [
                    'class' => 'btn btn-success',
                    'route' => 'todo.save',
                    'type' => 'submit',
                    'icon' => 'fa fa-plus'
                ]
            ]
        ];

    
        $sql = new Sql($this->adapter);

        $select = $sql->select();
        $select->from('tasks');
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $data['tasks'] = $results;

        $data['__csrf'] = $request->getAttribute('session')->get('__csrf');

        return new HtmlResponse($this->template->render('todo::index', $data));
    }
}
