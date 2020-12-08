<?php

declare(strict_types=1);

namespace App\Middleware;

use Mezzio\Csrf\CsrfMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;

class CsrfTokenMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        if ($request->getMethod() == 'GET') {
            $guard = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
            $guard->generateToken();

            return $handler->handle($request);
        } else {
            $data = $request->getParsedBody();
            $token = $data['__csrf'] ?? '';
            
            $guard = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
            
            if (! $guard->validateToken($token)) {
                return new EmptyResponse(419);
            }
            
            return $handler->handle($request);
        }
    }
}
