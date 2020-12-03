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

class TodoPageHandler implements RequestHandlerInterface
{
    /** @var string */
    private $containerName;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(string $containerName, Router\RouterInterface $router, ?TemplateRendererInterface $template = null
    ) {
        $this->containerName = $containerName;
        $this->router        = $router;
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // $data = [
        //     'forms' => [
        //         'title' => [
        //             'id' => 'title',
        //             'label' => 'Title',
        //             'type' => 'text', 
        //             'placeholde' => 'Enter title...',
        //             'class' => 'fomr-control'
        //         ], 
        //         'description' => [
        //             'id' => 'description',
        //             'label' => 'Description',
        //             'type' => 'textarea', 
        //             'placeholde' => 'Enter description...',
        //             'class' => 'fomr-control'
        //         ],
        //         'status' => [
        //             'btn' => [
        //                 'id' => 'status',
        //                 'label' => 'Status',
        //                 'type' => 'checkbox',
        //                 'checked' => True
        //             ]
        //         ],
        //         'buttons' => [
        //             'edit' => [
        //                 'class' => 'btn btn-primary',
        //                 'route' => 'todo.update',
        //                 'icon' => 'fa fa-pencil-alt'
        //             ],
        //             'delete' => [
        //                 'class' => "btn btn-danger",
        //                 'route' => 'todo.delete',
        //                 'icon' => "fa fa-times"
        //             ]
        //         ]
        //     ],
        //     'btn' => [
        //         'add' => [
        //             'class' => 'btn btn-success',
        //             'route' => 'todo.save',
        //             'type' => 'submit',
        //             'icon' => 'fa fa-plus'
        //         ]
        //     ]
        // ];

        // $adapter = new Adapter([
        //     'driver' => 'Pdo',
        //     'dsn'    => 'mysql:dbname=mezzio;host=localhost;charset=utf8',
        //     'username' => 'admin',
        //     'password' => '1q2w3e4r'
        // ]);
        // $sql = new Sql($adapter);

        // if($request->getMethod() == 'POST') {

        //     $data = $request->getParsedBody();
        //     if(!isset($data['status'])) {
        //         $data['status'] = 'off';
        //     }

        //     $insert = $sql->insert();
        //     $insert->into('tasks');
        //     $insert->columns(array_keys($data));
        //     $insert->values(array_values($data));
        //     $statement = $sql->prepareStatementForSqlObject($insert);
        //     $statement->execute();
            
        //     return new RedirectResponse('/todo');
        // }

        // $select = $sql->select();
        // $select->from('tasks');

        // $statement = $sql->prepareStatementForSqlObject($select);
        // $results = $statement->execute();

        // $data['tasks'] = $results;

        // return new HtmlResponse($this->template->render('todo::index', $data));
    }
}
