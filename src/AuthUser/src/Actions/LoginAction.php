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
use Mezzio\Authentication\AuthenticationInterface;

use function sha1;

class LoginAction implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $adapter;
    private $userInterface;

    public function __construct(TemplateRendererInterface $renderer, Adapter $adapter, AuthenticationInterface $userInterface)
    {
        $this->renderer = $renderer;
        $this->adapter = $adapter;
        $this->userInterface = $userInterface;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();

            $sql = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('users');
            $select->where(
                sprintf('email = "%s" AND password = "%s"', $data['email'], sha1($data['password']))
            );
            $stmt = $sql->prepareStatementForSqlObject($select);
            $result = $stmt->execute();
            $user = $result->current();

            // $securePass = sha1($user['password']);
            $user = $this->userInterface->authenticate($request);
            dd($this->userInterface, $user);
            
            if (null !== $user) {
                dd($user);
            }
            return $this->userInterface->unauthorizedResponse($request);

        }

        return new HtmlResponse($this->renderer->render(
            'auth::login',
            [
                '__csrf' => $request->getAttribute('session')->get('__csrf')
            ]
        ));
    }
}
