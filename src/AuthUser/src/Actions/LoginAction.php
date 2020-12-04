<?php

declare(strict_types=1);

namespace AuthUser\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

use function sha1;

class LoginAction implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            dd($data);
            //TODO sql query for check login and password
        }

        return new HtmlResponse($this->renderer->render(
            'auth::login'
        ));
    }
}
