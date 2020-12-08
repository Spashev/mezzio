<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class RegistorAction implements RequestHandlerInterface
{
    /**
     *
     * @var Adapter
     */
    private $adapter;
    
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, Adapter $adapter)
    {
        $this->renderer = $renderer;
        $this->adapter = $adapter;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if($request->getMethod == 'POST') {
            $sql = new Sql($this->adapter);

            

        }
        return new HtmlResponse($this->renderer->render(
            'auth::registor'
        ));
    }
}
